<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Brand;

/**
 * Brand datatable.
 *
 * @package App\DataTables\Dashboard
 */
class BrandDataTable extends DataTable
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
            'created_at',
            'updated_at',
            'action'
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

        ];
    }

    /**
     * @param Brand $brand
     * @return array
     */
    protected function getActions($brand)
    {
        return parent::getActions($brand);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param Brand $brand
     * @return string
     */
    protected function renderNameColumn($brand)
    {
        if ($this->isDataTableRequest()) {
            $template = "%d products";
            return $this->renderMediaView($brand->name, sprintf($template, $brand->products->count()), $brand->logo);
        }

        return $brand->name;
    }
}
