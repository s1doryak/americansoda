<?php

namespace App\Services\Api\V1;

use App\Company;
use App\Customer;
use App\CustomerOrder;
use App\CustomerOrderItem;
use App\CustomerPreOrder;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Eloquent\CustomerOrderRepositoryEloquent;
use App\Transformers\Api\V1\CustomerOrderTransformer;
use App\Transformers\Api\V1\CustomerPreOrderTransformer;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Http\Response;
use PDF;

class CustomerOrderService extends ResourceService
{
    /**
     * @var CustomerOrderRepositoryEloquent
     */
    protected $repository;

    /**
     * @var CustomerOrderItemService
     */
    protected $customerOrderItemService;

    /**
     * @var CompanyService;
     */
    protected $companyService;

    /**
     * @var CustomerPreOrderService
     */
    protected $customerPreOrderService;

    /**
     * @param CustomerOrderRepository $repository
     * @param CustomerOrderItemService $customerOrderItemService
     * @param CustomerPreOrderService $customerPreOrderService
     * @param CompanyService $companyService
     */
    public function __construct(
        CustomerOrderRepository $repository,
        CustomerOrderItemService $customerOrderItemService,
        CustomerPreOrderService $customerPreOrderService,
        CompanyService $companyService
    )
    {
        $this->repository = $repository;
        $this->customerOrderItemService = $customerOrderItemService;
        $this->customerPreOrderService = $customerPreOrderService;
        $this->companyService = $companyService;
    }

    /**
     * @param $orderId
     * @param boolean $inline
     * @return Response|string
     */
    public function getPdfFile($orderId, $inline = false)
    {
        $order = $this->repository->with([
            'customer',
            'user',
            'customer.billingRegion',
            'customer.shippingRegion',
            'customer.user',
            'customer.stock',
            'customer.stock.region'
        ])->find($orderId);

        $pdf = PDF::loadView('dashboard::documents.order-review', $this->prepareOrderReview($order));

        if ($inline) {
            $filename = sprintf('%s.pdf', $order->getOrderReviewFileName());

            return $pdf->inline($filename);

        } else {
            $filename = sprintf('%s/customer_orders/%s.pdf', storage_path('app'), $order->getOrderReviewStorageFileName());

            if (file_exists($filename)) {
                unlink($filename);
            }

            $pdf->save($filename);

            return $filename;
        }
    }

    /**
     * @param CustomerOrder $order
     * @param boolean $hideBackOrder
     * @param boolean $hideCancelled
     * @return array
     */
    protected function prepareOrderReview($order, $hideBackOrder = true, $hideCancelled = true)
    {
        /** @var Customer $customer */
        $customer = $order->customer;
        /** @var Company $company */
        $company = $this->companyService->with('region')->first();

        $orderItemsConditions = [
            'customer_order_id' => $order->getKey(),
        ];

        if ($hideBackOrder) {
            $orderItemsConditions['back_order'] = 0;
        }

        if ($hideCancelled) {
            $orderItemsConditions['cancelled'] = 0;
        }

        /** @var \Illuminate\Support\Collection|CustomerOrderItem[] $orderItems */
        $orderItems = $this->customerOrderItemService
            ->with([
                'product',
                'product.productGroup',
                'product.packageType'
            ])
            ->findWhere($orderItemsConditions);

        /** @var boolean $hasNegativeItems */
        $hasNegativeItems = $orderItems->filter(function (CustomerOrderItem $orderItem) {
            return $orderItem->total_price < 0;
        })->isNotEmpty();

        $orderDepositItems = $orderItems->filter(function (CustomerOrderItem $orderItem) {
            return $orderItem->deposit_enabled;
        });

        $totalVats = get_total_vats($orderItems);
        $totalDeposits = get_total_deposits($orderItems);
        $totalPrice = $orderItems->sum('total_price') + $orderDepositItems->sum('deposit_total_price');
        $totalVatPrice = $orderItems->sum('total_vat_price') + $orderDepositItems->sum('deposit_total_vat_price');

        return compact(
            'company',
            'customer',
            'order',
            'orderItems',
            'totalVats',
            'totalDeposits',
            'totalPrice',
            'totalVatPrice',
            'hasNegativeItems'
        );
    }

    /**
     * @param $shopId
     * @return mixed
     */
    public function getByShopId($shopId)
    {
        /** @var \Illuminate\Support\Collection|CustomerPreOrder[] $customerPreOrders */
        $customerPreOrders = $this->customerPreOrderService->getByShopId($shopId, true);

        /** @var \Illuminate\Support\Collection|CustomerOrder[] $customerOrders */
        $customerOrders = $this->repository->getByShopId($shopId);

        $customerPreOrders = $customerPreOrders->map(function ($customerPreOrder) {
            return CustomerPreOrderTransformer::toArray($customerPreOrder);
        });

        $customerOrders = $customerOrders->map(function ($customerOrder) {
            return CustomerOrderTransformer::toArray($customerOrder);
        });

        return collect()
            ->concat($customerPreOrders)
            ->concat($customerOrders);
    }
}
