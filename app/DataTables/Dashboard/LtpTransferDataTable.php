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
            'document_date',
            'picking_date',
            'picked', #todo: вот тут изначально 0%, обновляется после запроса к LTP
//            'departure',
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
            'document_date',
            'picking_date',
            'picked', #todo: вот тут изначально 0%, обновляется после запроса к LTP
//            'departure',
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
        return array_merge(parent::getActions($ltpTransfer), [
            'xml' => [
                'target' => '_blank',
                'url' => route(sprintf('%s.%s.xml', $this->prefix, $this->resource), $ltpTransfer->getKey()),
                'method' => 'post',
                'icon' => 'file',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.send.title', $this->resource)),
            ],
        ]);
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
