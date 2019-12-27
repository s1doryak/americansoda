<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerInvoiceItem;

/**
 * CustomerInvoiceItem datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerInvoiceItemDataTable extends DataTable
{
    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'position',
            'item_code',
            'subject',
            'definition',
            'price',
            'unit_type',
            'amount',
            'sum',
            'tax',
            'sum_tax',
            'discount',
            'customerInvoice.order_nr' => [
                'data' => 'customerInvoice.order_nr',
                'orderable' => false
            ],
            'customerOrderItem.product_name' => [
                'data' => 'customerOrderItem.product_name'
            ],
            'product.name' => [
                'data' => 'product.name'
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'position',
            'item_code',
            'subject',
            'definition',
            'price',
            'unit_type',
            'amount',
            'sum',
            'tax',
            'sum_tax',
            'discount',
            'invoice.name',
            'orderItem.name',
            'action',
        ];
    }

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
            'position',
            'amount',
            'tax',
            'discount',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
            'invoice.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'invoice.id',
                'lists' => 'invoice.name',
            ],
            'orderItem.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'orderItem.id',
                'lists' => 'orderItem.name',
            ],
            'product.name' => [
                'type' => 'choice',
                'multiple' => true,
                'operator' => 'in',
                'data' => 'product.id',
                'lists' => 'product.name',
            ],
        ];
    }

    /**
     * @param CustomerInvoiceItem $customerInvoiceItem
     * @return array
     */
    protected function getActions($customerInvoiceItem)
    {
        return parent::getActions($customerInvoiceItem);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param CustomerInvoiceItem $customerInvoiceItem
     * @return string
     */
    public function renderCustomerInvoice__OrderNrColumn($customerInvoiceItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerInvoiceItem->customerInvoice ? $customerInvoiceItem->customerInvoice->order_nr : $this->renderDefaultView();
        }

        return $customerInvoiceItem->customerInvoice->order_nr;
    }

    /**
     * @param CustomerInvoiceItem $customerInvoiceItem
     * @return string
     */
    public function renderCustomerOrderItem__ProductNameColumn($customerInvoiceItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerInvoiceItem->customerOrderItem ? $customerInvoiceItem->customerOrderItem->product_name : $this->renderDefaultView();
        }

        return $customerInvoiceItem->customerOrderItem->product_name;
    }

    /**
     * @param CustomerInvoiceItem $customerInvoiceItem
     * @return string
     */
    public function renderProduct__NameColumn($customerInvoiceItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerInvoiceItem->product ? $customerInvoiceItem->product->name : $this->renderDefaultView();
        }

        return $customerInvoiceItem->product->name;
    }
}
