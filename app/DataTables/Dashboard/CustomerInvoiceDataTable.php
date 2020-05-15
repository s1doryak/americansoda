<?php

namespace App\DataTables\Dashboard;

use DB;
use App\CustomerInvoice;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;

/**
 * CustomerInvoice datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerInvoiceDataTable extends DataTable
{
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'invoice_nr' => [
                'searchable' => true,
            ],
            'date',
            'reference_nr',
            'sum',
            'sum_tax',
            'company_reference',
            'customer_nr',
            'customer_bid',
            'customer_ovt',
            'customer.name' => [
                'data' => 'customer.name'
            ],
            'customerShipment.number' => [
                'data' => 'customerShipment.number'
            ],
            'maventa_sent_at',
            'maventa_paid',
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'invoice_nr',
            'date',
            'reference_nr',
            'sum',
            'sum_tax',
            'company_reference',
            'customer_nr',
            'customer_bid',
            'customer_ovt',
            'customer.name',
            'customerShipment.number',
            'maventa_sent_at',
            'maventa_paid',
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
            'date' => [
                'type' => 'daterangepicker',
                'name' => 'date',
                'items' => [],
                'query' => function ($query, $filterColumn, $value) {

                    /** @var \Illuminate\Support\Collection $dates */
                    $dates = collect(explode(' - ', $value));

                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    $query->whereRaw(
                        DB::raw(
                            sprintf(
                                "%s BETWEEN STR_TO_DATE('%s', '%s') AND STR_TO_DATE('%s', '%s')",
                                $filterColumn,
                                $dates->first(),
                                '%d/%m/%Y',
                                $dates->last(),
                                '%d/%m/%Y'
                            )
                        )
                    );
                },
            ],
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

        return array_merge($actions, $this->getDefaultActions($customerInvoice));
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

        return $customerInvoice->customer->name ?? null;
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

        return $customerInvoice->customerShipment->number ?? null;
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    public function renderMaventaSentAtColumn($customerInvoice)
    {
        if ($this->isDataTableRequest()) {
            $actionView = $customerInvoice->customer->paymentType->name === 'e-invoice'
                ? $this->getMaventaInvoiceSend($customerInvoice)
                : $this->getEmailInvoiceSend($customerInvoice);

            return $customerInvoice->maventa_sent_at
                ? format_date($customerInvoice->maventa_sent_at)
                : $actionView;
        }

        return $customerInvoice->maventa_sent_at ? format_date($customerInvoice->maventa_sent_at) : null;
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    public function renderMaventaPaidColumn($customerInvoice)
    {
        $label = $customerInvoice->maventa_paid ? 'models/customer_invoice.maventa_paid.true' : 'models/customer_invoice.maventa_paid.false';

        if ($this->isDataTableRequest()) {
            return $customerInvoice->maventa_sent_at
                ? $this->renderView('dashboard::resources.customer_invoice.columns.maventa_paid', [
                    'model' => $customerInvoice
                ])
                : '';
        }

        return trans($label);
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    protected function getMaventaInvoiceSend(CustomerInvoice $customerInvoice)
    {
        return $this->renderActionView([
            'send' => [
                'target' => '_blank',
                'url' => route(sprintf('%s.%s.maventa_sent_at', $this->prefix, $this->resource), $customerInvoice->getKey()),
                'method' => 'post',
                'icon' => 'cloud-upload',
                'color' => 'green',
                'title' => trans(sprintf('models/%s.send.title', $this->resource)),
            ]
        ], $customerInvoice);
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return string
     */
    protected function getEmailInvoiceSend(CustomerInvoice $customerInvoice)
    {
        return $this->renderActionView([
            'send' => [
                'url' => route(sprintf('%s.%s.send_email', $this->prefix, $this->resource), $customerInvoice->getKey()),
                'method' => 'post',
                'icon' => 'email',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.send_email.title', $this->resource)),
            ]
        ], $customerInvoice);
    }
}
