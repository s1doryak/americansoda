<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Customer;

/**
 * Customer datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerDataTable extends DataTable
{
    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => [
                'searchable' => true
            ],
            'legal_name' => [
                'searchable' => true
            ],

            'billingRegion.name' => [
                'data' => 'billingRegion.name',
            ],
            'billing_postcode' => [
                'searchable' => true
            ],
            'billing_address' => [
                'searchable' => true
            ],

            'shippingRegion.name' => [
                'data' => 'shippingRegion.name',
            ],
            'shipping_postcode' => [
                'searchable' => true
            ],
            'shipping_address' => [
                'searchable' => true
            ],

            'bid', // Business ID
            'iban',
            'swift',
            'email' => [
                'searchable' => true
            ],
            'phone' => [
                'searchable' => true
            ],
            'order_interval',
            'incomterms',
            'delivery_payer',
            'customerType.name' => [
                'data' => 'customerType.name',
            ],
            'paymentType.name' => [
                'data' => 'paymentType.name',
            ],
            'payment_conditions',
            'stock.name' => [
                'data' => 'stock.name',
                'searchable' => true
            ],
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
            'name',
            'comment',
            'action'
        ];
    }

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
            'order_interval' => [
                'function' => 'avg',
                'format' => '~%.02f',
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
            'billingRegion.id' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'billingRegion.id',
                'lists' => 'billingRegion.name',
            ],
            'shippingRegion.id' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'shippingRegion.id',
                'lists' => 'shippingRegion.name',
            ],
            'stock.id' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'stock.id',
                'lists' => 'stock.name',
            ],
            'customerType.id' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'customerType.id',
                'lists' => 'customerType.name',
            ],
        ];
    }

    /**
     * @param Customer $customer
     * @return array
     */
    protected function getActions($customer)
    {
        return parent::getActions($customer);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
