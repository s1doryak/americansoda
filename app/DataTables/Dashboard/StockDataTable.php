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
            'name' => [
                'searchable' => true,
            ],
            'postcode' => [
                'searchable' => true,
            ],
            'address' => [
                'searchable' => true,
            ],
            'region.name' => [
                'name' => 'region.name',
                'data' => 'region.name',
                'searchable' => true,
            ],
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'name',
            'postcode',
            'address',
            'region.name',
            'created_at',
            'updated_at',
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

    /**
     * @param Stock $stock
     * @return string
     */
    public function renderRegion__NameColumn($stock)
    {
        if ($this->isDataTableRequest()) {
           return $stock->region->name ?? $this->renderDefaultView();
        }

        return $stock->region->name;
    }
}
