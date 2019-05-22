<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Stock;

/**
 * Stock datatable.
 *
 * @package App\DataTables\Dashboard
 */
class StockDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'name',
				'postcode',
				'address',
				'region.name' => [
					'data' => 'region.name'
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
				'region.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'region.id',
					'lists' => 'region.name',
				],
        ];
    }

	/**
	 * @param Stock $stock
	 * @return array
	 */
	protected function getActions($stock)
	{
		return parent::getActions($stock);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
