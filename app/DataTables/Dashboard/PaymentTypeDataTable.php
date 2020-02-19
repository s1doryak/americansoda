<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\PaymentType;

/**
 * PaymentType datatable.
 *
 * @package App\DataTables\Dashboard
 */
class PaymentTypeDataTable extends DataTable
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
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'name',
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
	 * @param PaymentType $paymentType
	 * @return array
	 */
	protected function getActions($paymentType)
	{
		return parent::getActions($paymentType);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
