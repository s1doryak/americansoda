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
            //'maventa_id',
            //'maventa_tiff',
            //'maventa_initiated',
            //'currency',
            //'data',
            //'date',
            //'date_due',
            //'delivery_date',
            //'delivery_type',
            //'error_message',
            //'invoice_delivery_address',
            'invoice_nr',
            //'invoice_seller_information',
            //'lang',
            //'notes',
            'order_nr',
            //'payment_terms',
            'reference_nr',
            //'state',
            //'status',
            'sum',
            'sum_tax',
            //'work_order_nr',
            //'company_interest',
            //'company_paper_fee',
            //'company_reminder',
            //'company_comment',
            'company_reference',
            'customer_nr',
            //'customer_email',
            //'customer_name',
            //'customer_country',
            //'customer_state',
            //'customer_post_code',
            //'customer_post_office',
            //'customer_address1',
            //'customer_address2',
            //'customer_contact_p',
            'customer_bid',
            'customer_ovt',
            'customer.name' => [
                'data' => 'customer.name'
            ],
            'customerShipment.number' => [
                'data' => 'customerShipment.number'
            ],
            'maventa_paid',
            'maventa_sent_at',
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
            'maventa_paid',
            'maventa_sent_at',
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
            'customerShipment.number',
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
            /*'customerShipment.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'customerShipment.id',
                'lists' => 'customerShipment.name',
            ],*/
            /*'customerInvoiceItems.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'customerInvoiceItems.id',
                'lists' => 'customerInvoiceItems.name',
            ],*/
            /*'customerInvoiceActions.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'customerInvoiceActions.id',
                'lists' => 'customerInvoiceActions.name',
            ],*/
            /*'customerInvoiceAttachments.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'customerInvoiceAttachments.id',
                'lists' => 'customerInvoiceAttachments.name',
            ],*/
            /*'customerOrderItems.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'customerOrderItems.id',
                'lists' => 'customerOrderItems.name',
            ],*/
        ];
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return array
     */
    protected function getActions($customerInvoice)
    {
        $actions = [];

        if (false === $customerInvoice->maventa_initiated) {
            $actions['invoice'] = [
                'target' => '_blank',
                'url' => route(sprintf('%s.%s.invoice', $this->prefix, $this->resource), $customerInvoice->getKey()),
                'icon' => 'file-text',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.invoice.title', $this->resource)),
            ];
        }

        if ((string)$customerInvoice->maventa_tiff) {
            $actions['tiff'] = [
                'target' => '_blank',
                'url' => asset($customerInvoice->maventa_tiff),
                'icon' => 'file-text',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.tiff.title', $this->resource)),
            ];
        }

        return array_merge($actions, parent::getActions($customerInvoice));
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
    public function renderCustomer__NameColumn($customerInvoice)
    {
        if ($this->isDataTableRequest()) {
            return $customerInvoice->customer->name ?? $this->renderDefaultView();
        }

        return $customerInvoice->customer ? $customerInvoice->customer->name : '';
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    public function renderCustomerShipment__NumberColumn($customerInvoice)
    {
        if ($this->isDataTableRequest()) {
            return $customerInvoice->customerShipment->number ?? $this->renderDefaultView();
        }

        return $customerInvoice->customerShipment ? $customerInvoice->customerShipment->number : '';
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    public function renderMaventaPaidColumn($customerInvoice)
    {
        $label = $customerInvoice->maventa_paid ? 'models/customer_invoice.maventa_paid.true' : 'models/customer_invoice.maventa_paid.false';

        if ($this->isDataTableRequest()) {
            return $this->renderView('dashboard::resources.customer_invoice.columns.maventa_paid', [
                'model' => $customerInvoice
            ]);
        }

        return trans($label);
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    public function renderMaventaSentAtColumn($customerInvoice)
    {
        if ($this->isDataTableRequest()) {

            return $customerInvoice->maventa_sent_at
                ? format_date($customerInvoice->maventa_sent_at)
                : $this->renderActionView([
                    'send' => [
                        'target' => '_blank',
                        'url' => route(sprintf('%s.%s.maventa_sent_at', $this->prefix, $this->resource), $customerInvoice->getKey()),
                        'method' => 'post',
                        'icon' => 'upload',
                        'color' => 'green',
                        'title' => trans(sprintf('models/%s.send.title', $this->resource)),
                    ]
                ], $customerInvoice);
        }

        return $customerInvoice->maventa_sent_at ? format_date($customerInvoice->maventa_sent_at) : null;
    }
}
