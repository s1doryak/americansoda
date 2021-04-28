<?php

namespace App\DataTables\Dashboard;

use App\CustomerShipment;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;

/**
 * CustomerShipment datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerShipmentDataTable extends DataTable
{
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'number' => [
                'searchable' => true,
            ],
            'customer.name' => [
                'name' => 'customer.name',
                'data' => 'customer.name',
                'searchable' => true,
            ],
            'packageType.name' => [
                'name' => 'packageType.name',
                'data' => 'packageType.name',
            ],
            'packages_quantity',
            'customerOrderItems.customerOrder.number' => [
                'searchable' => true,
                'orderable' => false,
            ],
            'customerOrderItems.customerOrder.batch_number' => [
                'searchable' => true,
                'orderable' => false,
            ],
            'status' => [
                'template' => 'dashboard::resources.customer_shipment.columns.status',
            ],
            'assembly_number',
            'invoice_number',
            'delivery_date',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @return array
     */
    public function getRawColumns()
    {
        return [
            'number',
            'customer.name',
            'status',
            'action',
            'packageType.name'
        ];
    }

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
            'customer.name' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'customer.id',
                'lists' => 'customer.name',
            ],
            'number' => [
                'type' => 'text',
                'name' => 'number',
                'data' => 'number',
            ],
            'status' => [
                'type' => 'select',
                'multiple' => false,
                'items' => [
                    [
                        'key' => '',
                        'value' => 'Any',
                    ],
                    [
                        'key' => 'open',
                        'value' => 'Open',
                    ],
                    [
                        'key' => 'assembly',
                        'value' => 'Assembly',
                    ],
                    [
                        'key' => 'shipment',
                        'value' => 'Shipment',
                    ],
                    [
                        'key' => 'invoice',
                        'value' => 'Invoice',
                    ],
                ],
            ],
        ];
    }

    /**
     * @param CustomerShipment $customerShipment
     * @return array
     */
    protected function getActions($customerShipment)
    {
        $defaults = $this->getDefaultActions($customerShipment);

        $actions = [
            'toLtpTransfer' => [
                'resource' => 'ltp_transfer',
                'url' => route(
                    sprintf('%s.%s.toLtpTransfer', $this->prefix, $this->resource),
                    $customerShipment->getKey()
                ),
                'target' => '_blank',
                'icon' => 'truck',
                'color' => $customerShipment->ltpTransfer ? 'primary' : 'green',
                'title' => trans(sprintf('models/%s.toLtpTransfer.title', $this->resource)),
            ],
            'invoice' => [
                'url' => route(
                    sprintf('%s.%s.invoice', $this->prefix, $this->resource),
                    $customerShipment->getKey()
                ),
                'target' => '_blank',
                'icon' => 'file-plus',
                'color' => $customerShipment->customerInvoice ? 'primary' : 'green',
                'title' => trans(sprintf('models/%s.invoice.title', $this->resource)),
            ],
            'package_list' => [
                'url' => route(
                    sprintf('%s.%s.package_list', $this->prefix, $this->resource),
                    $customerShipment->getKey()
                ),
                'target' => '_blank',
                'icon' => 'widgets',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.package_list.title', $this->resource)),
            ],
            'waybill' => [
                'url' => route(
                    sprintf('%s.%s.waybill', $this->prefix, $this->resource),
                    $customerShipment->getKey()
                ),
                'target' => '_blank',
                'icon' => 'file-text',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.waybill.title', $this->resource)),
            ],
        ];
        
        return array_merge($actions, $defaults);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param CustomerShipment $customerShipment
     * @return string
     */
    public function renderCustomer__NameColumn($customerShipment)
    {
        if ($this->isDataTableRequest()) {
            return $customerShipment->customer->renderName() ?? $this->renderDefaultView();
        }
        return $customerShipment->customer->name ?? null;
    }

    /**
     * @param CustomerShipment $customerShipment
     * @return string
     */
    public function renderCustomerOrderItems__customerOrder__numberColumn($customerShipment)
    {
        return $customerShipment->order_numbers;
    }

    /**
     * @param CustomerShipment $customerShipment
     * @return string
     */
    public function renderCustomerOrderItems__customerOrder__batchNumberColumn($customerShipment)
    {
        return $customerShipment->order_batch_numbers;
    }

    /**
     * @param CustomerShipment $customerShipment
     * @return string
     */
    public function renderPackageType__NameColumn($customerShipment)
    {
        if ($this->isDataTableRequest()) {
            return $customerShipment->packageType->name ?? $this->renderDefaultView();
        }

        return $customerShipment->packageType->name ?? null;
    }

    /**
     * @param CustomerShipment $customerShipment
     * @return string
     */
    public function renderCustomer__User__NameColumn($customerShipment)
    {
        if ($this->isDataTableRequest()) {
            return $customerShipment->customer->user ? $customerShipment->customer->user->name : $this->renderDefaultView();
        }

        return $customerShipment->customer->user ? $customerShipment->customer->user->name : null;
    }
}
