<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\StockProduct;

/**
 * StockProduct datatable.
 *
 * @package App\DataTables\Dashboard
 */
class StockProductDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'delivery_number',
				'expiration_date',
				'stock.name' => [
					'data' => 'stock.name'
				],
				'product.name' => [
					'data' => 'product.name'
				],
				'customerOrderItem.name' => [
					'data' => 'customerOrderItem.name'
				],
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
				'stock.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'stock.id',
					'lists' => 'stock.name',
				],
				'product.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'product.id',
					'lists' => 'product.name',
				],
				'customerOrderItem.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'customerOrderItem.id',
					'lists' => 'customerOrderItem.name',
				],
        ];
    }

	/**
	 * @param StockProduct $stockProduct
	 * @return array
	 */
	protected function getActions($stockProduct)
	{
		return parent::getActions($stockProduct);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
