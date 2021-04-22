<?php

namespace App\DataTables\Dashboard;

use App\LtpTransfer;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;

/**
 * LtpTransfer datatable.
 *
 * @package App\DataTables\Dashboard
 */
class LtpTransferDataTable extends DataTable
{
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'requested_delivery_date',
            'document_number',
            'name',
            'invoicing_reference',
            'document_date',
            'picking_date',
            'picked',
            'departure',
            'warehouse'
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'requested_delivery_date',
            'document_number',
            'name',
            'invoicing_reference',
            'document_date',
            'picking_date',
            'picked',
            'departure',
            'warehouse',
            'action'
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

        ];
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return array
     */
    protected function getActions($ltpTransfer)
    {
        return array_merge([
            'xml' => [
                'target' => '_blank',
                'url' => route(sprintf('%s.%s.xml', $this->prefix, $this->resource), $ltpTransfer->getKey()),
                'method' => 'post',
                'icon' => 'code',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.send.title', $this->resource)),
            ],
        ], parent::getActions($ltpTransfer));
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderRequestedDeliveryDateColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {

            return $ltpTransfer->requested_delivery_date->format('Y-m-d');
        }

        return $ltpTransfer->requested_delivery_date;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderDocumentDateColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            $actionView = $this->getSendToLtpAction($ltpTransfer);

            return $ltpTransfer->document_date
                ? format_date($ltpTransfer->document_date)
                : $actionView;
        }

        return $ltpTransfer->document_date;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderPickedColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            $picked = 0;

            return sprintf('%s&nbsp;%%', $picked);
        }

        return 0;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderPickingDateColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            return $ltpTransfer->picking_date ? format_date($ltpTransfer->picking_date) : $this->renderDefaultView();
        }

        return $ltpTransfer->picking_date;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderWarehouseColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            return $ltpTransfer->warehouse ?: 'KT Katriinantie';
        }

        return $ltpTransfer->warehouse ?: 'KT Katriinantie';
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderDepartureColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            #todo: Предположительно это поле после ответа
            return $this->renderDefaultView();
        }

        return null;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderinvoicingReferenceColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            #todo: Не уверен что именно эта колонка нужна
            return $ltpTransfer->invoicing_reference ?: $this->renderDefaultView();
        }

        return $ltpTransfer->invoicing_reference;
    }

    protected function getSendToLtpAction(LtpTransfer $ltpTransfer)
    {
        return $this->renderActionView([
            'send' => [
                'target' => '_blank',
                'url' => route(sprintf('%s.%s.sendToLtp', $this->prefix, $this->resource), $ltpTransfer->getKey()),
                'method' => 'post',
                'icon' => 'cloud-upload',
                'color' => 'blue',
                'title' => trans(sprintf('models/%s.send.title', $this->resource)),
            ]
        ], $ltpTransfer);
    }
}
