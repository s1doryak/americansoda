<?php

namespace App\Services\Api\V1;

use App\CustomerOrderItem;
use App\Repositories\Eloquent\CompanyRepositoryEloquent;
use App\Repositories\Eloquent\CustomerOrderItemRepositoryEloquent;
use App\Repositories\Eloquent\CustomerOrderRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use PDF;

class CustomerOrderService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(CustomerOrderRepositoryEloquent::class);
    }

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

    protected function prepareOrderReview($order, $hideBackOrder = true, $hideCancelled = true)
    {
        $customer = $order->customer;
        $companyRepository = app(CompanyRepositoryEloquent::class);
        $company = $companyRepository->with('region')->first();
        $orderItemsConditions = [
            'customer_order_id' => $order->getKey(),
        ];

        if ($hideBackOrder) {
            $orderItemsConditions['back_order'] = 0;
        }

        if ($hideCancelled) {
            $orderItemsConditions['cancelled'] = 0;
        }

        $customerOrderItemRepository = app(CustomerOrderItemRepositoryEloquent::class);
        $orderItems = $customerOrderItemRepository->with(['product', 'product.productGroup', 'product.packageType'])->findWhere($orderItemsConditions);

        /** @var boolean $hasNegativeItems */
        $hasNegativeItems = $orderItems->filter(function (CustomerOrderItem $orderItem) {
            return $orderItem->total_price < 0;
        })->isNotEmpty();

        /** @var \Illuminate\Database\Eloquent\Collection $orderDepositItems */
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
}