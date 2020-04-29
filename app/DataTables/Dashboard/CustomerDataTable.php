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
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => [
                'searchable' => true
            ],
            /*'legal_name' => [
                'searchable' => true
            ],*/
            /*'billingRegion.name' => [
                'data' => 'billingRegion.name',
            ],*/
            /*'billing_postcode' => [
                'searchable' => true
            ],*/
            /* 'billing_address' => [
                 'searchable' => true
             ],*/

            /*'shippingRegion.name' => [
                'data' => 'shippingRegion.name',
            ],*/
            /*'shipping_postcode' => [
                'searchable' => true
            ],*/
            /*'shipping_address' => [
                'searchable' => true
            ],*/
            //'nr',
            //'y_tunnus',
            //'iban',
            //'swift',
            'email' => [
                'searchable' => true
            ],
            'phone' => [
                'searchable' => true
            ],
            'order_interval',
            'incomterms',
            //'delivery_payer',
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
            'archived',
            //'country',
            //'state',
            //'post_code',
            //'post_office',
            //'address1',
            //'address2',
            //'contact_p',
            //'bid',
            //'ovt',
            'priceGroup.name' => [
                'data' => 'priceGroup.name'
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
            'priceGroup.name',
            'action',
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
            'billingRegion.name' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'billingRegion.id',
                'lists' => 'billingRegion.name',
            ],
            'shippingRegion.name' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'shippingRegion.id',
                'lists' => 'shippingRegion.name',
            ],
            'customerType.name' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'customerType.id',
                'lists' => 'customerType.name',
            ],
            'priceGroup.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'priceGroup.id',
                'lists' => 'priceGroup.name',
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

    /**
     * @param Customer $customer
     * @return string
     */
    public function renderNameColumn($customer)
    {
        if ($this->isDataTableRequest()) {
            return $customer->renderName();
        }

        return $customer->name;
    }

    /**
     * @param Customer $customer
     * @return string
     */
    public function renderCustomerType__NameColumn($customer)
    {
        if ($this->isDataTableRequest()) {
            return $customer->customerType->name ?? $this->renderDefaultView();
        }

        return $customer->customerType->name ?? null;
    }

    /**
     * @param Customer $customer
     * @return string
     */
    public function renderPaymentType__NameColumn($customer)
    {
        if ($this->isDataTableRequest()) {
            return $customer->paymentType->name ?? $this->renderDefaultView();
        }

        return $customer->paymentType->name ?? null;
    }

    /**
     * @param Customer $customer
     * @return string
     */
    public function renderPriceGroup__NameColumn($customer)
    {
        if ($this->isDataTableRequest()) {
            return $customer->priceGroup->name ?? $this->renderDefaultView();
        }

        return $customer->priceGroup->name ?? null;
    }

    /**
     * @param Customer $customer
     * @return string
     */
    public function renderStock__NameColumn($customer)
    {
        if ($this->isDataTableRequest()) {
            return $customer->stock->name ?? $this->renderDefaultView();
        }

        return $customer->stock->name ?? null;
    }
}
