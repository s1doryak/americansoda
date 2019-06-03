<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerInvoiceItem;

/**
 * CustomerInvoiceItem datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerInvoiceItemDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'position',
			'item_code',
			'subject',
			'definition',
			'price',
			'unit_type',
			'amount',
			'sum',
			'tax',
			'sum_tax',
			'discount',
			'invoice.name' => [
				'data' => 'invoice.name'
			],
			'orderItem.name' => [
				'data' => 'orderItem.name'
			],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'position',
			'item_code',
			'subject',
			'definition',
			'price',
			'unit_type',
			'amount',
			'sum',
			'tax',
			'sum_tax',
			'discount',
			'invoice.name',
			'orderItem.name',
			'action',
		];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
			'position',
			'amount',
			'tax',
			'discount',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
			'invoice.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'invoice.id',
				'lists' => 'invoice.name',
			],
			'orderItem.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'orderItem.id',
				'lists' => 'orderItem.name',
			],
        ];
    }

	/**
	 * @param CustomerInvoiceItem $customerInvoiceItem
	 * @return array
	 */
	protected function getActions($customerInvoiceItem)
	{
		return parent::getActions($customerInvoiceItem);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
