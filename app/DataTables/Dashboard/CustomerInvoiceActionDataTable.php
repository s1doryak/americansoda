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
			'customerInvoice.order_nr' => [
				'data' => 'customerInvoice.order_nr',
                'orderable' => false
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
			'customerInvoice.order_nr',
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
				'lists' => 'customerInvoice.order_nr',
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

    /**
     * @param CustomerInvoiceAction $customerInvoiceAction
     * @return string
     */
    public function renderCustomerInvoice__OrderNrColumn($customerInvoiceAction)
    {
        if ($this->isDataTableRequest()) {
            return $customerInvoiceAction->customerInvoice ? $customerInvoiceAction->customerInvoice->order_nr : $this->renderDefaultView();
        }

        return $customerInvoiceAction->customerInvoice->order_nr;
    }
}
