<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerOrderItem;

/**
 * CustomerOrderItem datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerOrderItemDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'status',
				'product_name',
				'sales_unit_quantity',
				'product_manual_price',
				'product_price',
				'vat',
				'product_vat_price',
				'products_quantity',
				'packages_quantity',
				'total_price',
				'total_vat_price',
				'deposit_enabled',
				'deposit_price',
				'deposit_vat',
				'deposit_vat_price',
				'deposit_total_price',
				'deposit_total_vat',
				'deposit_total_vat_price',
				'bypass',
				'back_order',
				'cancelled',
				'expected_date',
				'product.name' => [
					'data' => 'product.name'
				],
				'customer.name' => [
					'data' => 'customer.name'
				],
				'customerOrder.name' => [
					'data' => 'customerOrder.name'
				],
				'customerShipment.name' => [
					'data' => 'customerShipment.name'
				],
		];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
				'sales_unit_quantity',
				'product_price',
				'vat',
				'product_vat_price',
				'products_quantity',
				'packages_quantity',
				'total_price',
				'total_vat_price',
				'deposit_price',
				'deposit_vat',
				'deposit_vat_price',
				'deposit_total_price',
				'deposit_total_vat',
				'deposit_total_vat_price',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
				'product.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'product.id',
					'lists' => 'product.name',
				],
				'customer.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'customer.id',
					'lists' => 'customer.name',
				],
				'customerOrder.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'customerOrder.id',
					'lists' => 'customerOrder.name',
				],
				'customerShipment.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'customerShipment.id',
					'lists' => 'customerShipment.name',
				],
        ];
    }

	/**
	 * @param CustomerOrderItem $customerOrderItem
	 * @return array
	 */
	protected function getActions($customerOrderItem)
	{
		return parent::getActions($customerOrderItem);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
