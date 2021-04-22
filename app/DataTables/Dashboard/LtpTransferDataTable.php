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
            'name',
            'document_number',
            'document_date',
            'document_type',
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'requested_delivery_date',
            'name',
            'document_number',
            'document_date',
            'document_type',
            'action',
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
        return parent::getActions($ltpTransfer);
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

    protected function getSendToLtpAction(LtpTransfer $ltpTransfer)
    {
        return $this->renderActionView([
            'sendToLtp' => [
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
