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
            'stock.name' => [
                'name' => 'stock.name',
                'data' => 'stock.name',
                'searchable' => true
            ],
            'movement_type',
            'created_at',
            'updated_at',
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
