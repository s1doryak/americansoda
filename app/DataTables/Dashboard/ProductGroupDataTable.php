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
     * Enable or disable table pagination.
     * @see https://datatables.net/reference/option/paging
     * @var boolean
     */
    protected $paging = false;

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
            'productType.name' => [
                'data' => 'productType.name'
            ],
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
            'action',
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
            'productType.name' => [
                'type' => 'choice',
                'multiple' => true,
                'operator' => 'in',
                'data' => 'productType.id',
                'lists' => 'productType.name',
            ],
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

    /**
     * @param ProductGroup $productGroup
     * @return string
     */
    public function renderProductType__NameColumn($productGroup)
    {
        if ($this->isDataTableRequest()) {
            return $productGroup->productType ? $productGroup->productType->name : $this->renderDefaultView();
        }

        return optional($productGroup->productType)->name;
    }
}
