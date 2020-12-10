<?php

namespace App\Services\Api\V1;

use App\Company;
use App\Customer;
use App\CustomerOrderItem;
use App\CustomerShipment;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Eloquent\CompanyRepositoryEloquent;
use App\Repositories\Eloquent\CustomerOrderItemRepositoryEloquent;
use App\Repositories\Eloquent\CustomerShipmentRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Http\Response;
use PDF;

class CustomerShipmentService extends ResourceService
{
    /**
     * @var CustomerShipmentRepositoryEloquent
     */
    protected $repository;

    /**
     * @var CompanyRepositoryEloquent
     */
    protected $companyService;

    /**
     * @var CustomerOrderItemRepositoryEloquent
     */
    protected $customerOrderItemService;

    /**
     * CustomerShipmentService constructor.
     * @param CustomerShipmentRepository $repository
     * @param CompanyService $companyService
     * @param CustomerOrderItemService $customerOrderItemService
     */
    public function __construct(
        CustomerShipmentRepository $repository,
        CompanyService $companyService,
        CustomerOrderItemService $customerOrderItemService
    )
    {
        $this->repository = $repository;
        $this->companyService = $companyService;
        $this->customerOrderItemService = $customerOrderItemService;
    }

    /**
     * @param integer $shipmentId
     * @param boolean $inline
     * @return Response|string
     */
    public function getPdfFile($shipmentId, $inline = false)
    {
        /**
         * @var CustomerShipment $shipment
         */
        $shipment = $this->repository->with([
            'packageType',
            'customer',
            'customer.billingRegion',
            'customer.shippingRegion',
            'customer.user',
            'customer.stock',
            'customer.stock.region'
        ])->find($shipmentId);

        $pdf = PDF::loadView('dashboard::documents.package-list', $this->prepareShipmentData($shipment));

        if ($inline) {

            $filename = sprintf('%s.pdf', $shipment->getCustomerShipmentStorageFilename());

            return $pdf->inline($filename);

        } else {

            $filename = sprintf('%s/customer_shipments/%s.pdf', storage_path('app'), $shipment->getCustomerShipmentStorageFilename());

            if (file_exists($filename)) {
                unlink($filename);
            }

            $pdf->save($filename);

            return $filename;
        }
    }

    /**
     * @param CustomerShipment $shipment
     * @param boolean $hideBackOrder
     * @param boolean $hideCancelled
     * @return array
     */
    protected function prepareShipmentData($shipment, $hideBackOrder = true, $hideCancelled = true)
    {
        $customerOrderItemIds = $shipment->customerOrderItems->pluck('id')->toArray();

        /** @var Company $company */
        $company = $this->companyService->with('region')->first();

        /** @var Customer $customer */
        $customer = $shipment->customer;

        $orderItemsConditions = [
            [
                function ($query) use ($customerOrderItemIds) {
                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    $query->whereIn('id', $customerOrderItemIds);
                },
                null,
                null
            ]
        ];

        if ($hideBackOrder) {
            $orderItemsConditions['back_order'] = 0;
        }

        if ($hideCancelled) {
            $orderItemsConditions['cancelled'] = 0;
        }

        /** @var \Illuminate\Database\Eloquent\Collection $shipmentItems */
        $shipmentItems = $this->customerOrderItemService->with([
            'product',
            'product.productGroup',
            'product.packageType',
            'customerOrder',
            'customerShipment'
        ])->findWhere($orderItemsConditions);

        /** @var \Illuminate\Database\Eloquent\Collection $orderDepositItems */
        $orderDepositItems = $shipmentItems->filter(function (CustomerOrderItem $shipmentItem) {
            return $shipmentItem->deposit_enabled;
        });

        $totalVats = get_total_vats($shipmentItems);
        $totalDeposits = get_total_deposits($shipmentItems);
        $totalPrice = $shipmentItems->sum('total_price') + $orderDepositItems->sum('deposit_total_price');
        $totalVatPrice = $shipmentItems->sum('total_vat_price') + $orderDepositItems->sum('deposit_total_vat_price');

        return compact(
            'company',
            'customer',
            'shipment',
            'shipmentItems',
            'totalVats',
            'totalDeposits',
            'totalPrice',
            'totalVatPrice'
        );
    }
}
