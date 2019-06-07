<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerPreOrderItem;

/**
 * CustomerPreOrderItem datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerPreOrderItemDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'quantity',
			'products_quantity',
			'price',
			'vat_price',
			'total_price',
			'total_vat_price',
			'deposit_price',
			'deposit_vat_price',
			'total_deposit_price',
			'total_deposit_vat_price',
			'customerPreOrder.number' => [
				'data' => 'customerPreOrder.number'
			],
			'customerUser.name' => [
				'data' => 'customerUser.name'
			],
			'customer.name' => [
				'data' => 'customer.name'
			],
			'product.name' => [
				'data' => 'product.name'
			],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'quantity',
			'products_quantity',
			'price',
			'vat_price',
			'total_price',
			'total_vat_price',
			'deposit_price',
			'deposit_vat_price',
			'total_deposit_price',
			'total_deposit_vat_price',
			'customerPreOrder.number',
			'customerUser.name',
			'customer.name',
			'product.name',
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
			'customerPreOrder.number' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customerPreOrder.id',
				'lists' => 'customerPreOrder.number',
			],
			'customerUser.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customerUser.id',
				'lists' => 'customerUser.name',
			],
			'customer.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customer.id',
				'lists' => 'customer.name',
			],
			'product.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'product.id',
				'lists' => 'product.name',
			],
        ];
    }

	/**
	 * @param CustomerPreOrderItem $customerPreOrderItem
	 * @return array
	 */
	protected function getActions($customerPreOrderItem)
	{
		return parent::getActions($customerPreOrderItem);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
