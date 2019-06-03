<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerInvoiceAction;

/**
 * CustomerInvoiceAction datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerInvoiceActionDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'action',
			'timestamp',
			'customerInvoice.name' => [
				'data' => 'customerInvoice.name'
			],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'action',
			'timestamp',
			'customerInvoice.name',
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
			'customerInvoice.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customerInvoice.id',
				'lists' => 'customerInvoice.name',
			],
        ];
    }

	/**
	 * @param CustomerInvoiceAction $customerInvoiceAction
	 * @return array
	 */
	protected function getActions($customerInvoiceAction)
	{
		return parent::getActions($customerInvoiceAction);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
