<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\ProductGroup;

/**
 * ProductGroup datatable.
 *
 * @package App\DataTables\Dashboard
 */
class ProductGroupDataTable extends DataTable
{
    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => [
                'searchable' => true
            ],
            'vat',
            'sales_unit_volume',
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
            'vat',
            'sales_unit_volume',
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
            'vat',
            'sales_unit_volume',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [

        ];
    }

    /**
     * @param ProductGroup $productGroup
     * @return array
     */
    protected function getActions($productGroup)
    {
        return parent::getActions($productGroup);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
