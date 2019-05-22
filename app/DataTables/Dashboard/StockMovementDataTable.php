<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\StockMovement;

/**
 * StockMovement datatable.
 *
 * @package App\DataTables\Dashboard
 */
class StockMovementDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'movement_type',
				'stock.name' => [
					'data' => 'stock.name'
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
        ];
    }

	/**
	 * @param StockMovement $stockMovement
	 * @return array
	 */
	protected function getActions($stockMovement)
	{
		return parent::getActions($stockMovement);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
