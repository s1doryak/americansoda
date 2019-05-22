<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\StockMovementProduct;

/**
 * StockMovementProduct datatable.
 *
 * @package App\DataTables\Dashboard
 */
class StockMovementProductDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'product_name',
				'products_quantity',
				'delivery_number',
				'expiration_date',
				'movement_type',
				'comment',
				'stockMovement.name' => [
					'data' => 'stockMovement.name'
				],
				'product.name' => [
					'data' => 'product.name'
				],
		];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
				'products_quantity',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
				'stockMovement.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'stockMovement.id',
					'lists' => 'stockMovement.name',
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
	 * @param StockMovementProduct $stockMovementProduct
	 * @return array
	 */
	protected function getActions($stockMovementProduct)
	{
		return parent::getActions($stockMovementProduct);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
