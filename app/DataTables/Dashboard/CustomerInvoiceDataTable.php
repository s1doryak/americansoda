<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerInvoice;

/**
 * CustomerInvoice datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerInvoiceDataTable extends DataTable
{
    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'maventa_id',
            'maventa_tiff',
            'maventa_initiated',
            'currency',
            'data',
            'date',
            'date_due',
            'delivery_date',
            'delivery_type',
            'error_message',
            'invoice_delivery_address',
            'invoice_nr',
            'invoice_seller_information',
            'lang',
            'notes',
            'order_nr',
            'payment_terms',
            'reference_nr',
            'state',
            'status',
            'sum',
            'sum_tax',
            'work_order_nr',
            'company_interest',
            'company_paper_fee',
            'company_reminder',
            'company_comment',
            'company_reference',
            'customer_nr',
            'customer_email',
            'customer_name',
            'customer_country',
            'customer_state',
            'customer_post_code',
            'customer_post_office',
            'customer_address1',
            'customer_address2',
            'customer_contact_p',
            'customer_bid',
            'customer_ovt',
            'customer.name' => [
                'data' => 'customer.name'
            ],
            'customerShipment.name' => [
                'data' => 'customerShipment.name'
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'maventa_id',
            'maventa_tiff',
            'maventa_initiated',
            'currency',
            'data',
            'date',
            'date_due',
            'delivery_date',
            'delivery_type',
            'error_message',
            'invoice_delivery_address',
            'invoice_nr',
            'invoice_seller_information',
            'lang',
            'notes',
            'order_nr',
            'payment_terms',
            'reference_nr',
            'state',
            'status',
            'sum',
            'sum_tax',
            'work_order_nr',
            'company_interest',
            'company_paper_fee',
            'company_reminder',
            'company_comment',
            'company_reference',
            'customer_nr',
            'customer_email',
            'customer_name',
            'customer_country',
            'customer_state',
            'customer_post_code',
            'customer_post_office',
            'customer_address1',
            'customer_address2',
            'customer_contact_p',
            'customer_bid',
            'customer_ovt',
            'customer.name',
            'customerShipment.name',
            'action',
        ];
    }

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
            'state',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
            'customer.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'customer.id',
                'lists' => 'customer.name',
            ],
            'customerShipment.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'customerShipment.id',
                'lists' => 'customerShipment.name',
            ],
            'items.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'items.id',
                'lists' => 'items.name',
            ],
            'actions.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'actions.id',
                'lists' => 'actions.name',
            ],
            'attachments.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'attachments.id',
                'lists' => 'attachments.name',
            ],
            'orderItems.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'orderItems.id',
                'lists' => 'orderItems.name',
            ],
        ];
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return array
     */
    protected function getActions($customerInvoice)
    {
        return parent::getActions($customerInvoice);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    protected function renderMaventaTiffColumn($customerInvoice)
    {
        if ($this->isDataTableRequest()) {
            if ((string)$customerInvoice->maventa_tiff) {
                return $this->renderActionView([
                    'tiff' => [
                        '_blank' => true,
                        'url' => asset($customerInvoice->maventa_tiff),
                        'icon' => 'file-text',
                        'color' => 'primary',
                        'title' => trans(sprintf('models/%s.columns.tiff', $this->resource)),
                    ],
                ]);
            }

            return $this->renderView('datatables::columns.default');
        }

        return $customerInvoice->maventa_tiff ? (string)$customerInvoice->maventa_tiff : '';
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    protected function renderCustomer__NameColumn($customerInvoice)
    {
        if ($this->isDataTableRequest()) {
            if ($customerInvoice->customer) {
                return $customerInvoice->customer->name;
            }

            return $this->renderView('datatables::columns.default');
        }

        return $customerInvoice->customer ? $customerInvoice->customer->name : '';
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    protected function renderCustomerShipment__NameColumn($customerInvoice)
    {
        if ($this->isDataTableRequest()) {
            if ($customerInvoice->customerShipment) {
                return $customerInvoice->customerShipment->number;
            }

            return $this->renderView('datatables::columns.default');
        }

        return $customerInvoice->customerShipment ? $customerInvoice->customerShipment->number : '';
    }
}
