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
            'created_at',
            'waybill',
            'assembly',
            '',
            'document_type',
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'document_type',
            'document_number',
            'requested_delivery_date',
            'created_at',
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
    public function renderCreatedAtColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {

            return $ltpTransfer->created_at->format('Y-m-d H:i');
        }

        return $ltpTransfer->created_at;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderAssemblyColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {

            return $ltpTransfer->requested_delivery_date->format('Y-m-d H:i');
        }

        return $ltpTransfer->requested_delivery_date;
    }
}
