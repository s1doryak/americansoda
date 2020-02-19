<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\ProductType;

/**
 * ProductType datatable.
 *
 * @package App\DataTables\Dashboard
 */
class ProductTypeDataTable extends DataTable
{
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name',
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'name',
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
            'productGroups.name' => [
                'type' => 'choice',
                'multiple' => true,
                'operator' => 'in',
                'data' => 'productGroups.id',
                'lists' => 'productGroups.name',
            ],
        ];
    }

    /**
     * @param ProductType $productType
     * @return array
     */
    protected function getActions($productType)
    {
        return parent::getActions($productType);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param ProductType $productType
     * @return string
     */
    public function renderNameColumn($productType)
    {
        if ($this->isDataTableRequest()) {
            $transCount = $productType->productGroups()->count();
            $productGroupCount = trans_choice('models/product_type.columns.productGroups.count', $transCount, ['count' => $transCount]);

            return $this->renderMediaView($productType->name, $productGroupCount, $productType->image, 'image');
        }

        return $productType->name;
    }
}
