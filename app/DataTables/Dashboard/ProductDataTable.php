<?php

namespace App\DataTables\Dashboard;

use App\ProductTag;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Product;

/**
 * Product datatable.
 *
 * @package App\DataTables\Dashboard
 */
class ProductDataTable extends DataTable
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
            'product_barcode',
            'package_barcode',
            'number_in_package',
            'unit_type',
            'productGroup.name' => [
                'data' => 'productGroup.name',
                'searchable' => true
            ],
            'packageType.name' => [
                'data' => 'packageType.name',
            ],
            'productTags.name' => [
                'data' => 'productTags.name',
            ],
            'volume',
            'brutto_volume',
            'comment',
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
            'product_barcode',
            'package_barcode',
            'number_in_package',
            'unit_type',
            'productGroup.name',
            'packageType.name',
            'productTags.name',
            'volume',
            'brutto_volume',
            'comment',
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
            'brand.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'brand.id',
                'lists' => 'brand.name',
            ],
            'packageType.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'packageType.id',
                'lists' => 'packageType.name',
            ],
            'productGroup.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'productGroup.id',
                'lists' => 'productGroup.name',
            ],
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    protected function getActions($product)
    {
        return parent::getActions($product);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param Product $product
     * @return string
     */
    public function renderNameColumn($product)
    {
        if ($this->isDataTableRequest()) {
            $brand = $product->brand ? $product->brand->name : $this->renderView('datatables::columns.default');

            return $this->renderMediaView($product->name, $brand, $product->product_image);
        }

        return $product->name;
    }

    /**
     * @param Product $product
     * @return string
     */
    public function renderProductTags__NameColumn($product)
    {
        $fallback = $product->productTags->map(function (ProductTag $productTag) {
            return sprintf("%s", $productTag->name);
        })->implode(",");


        if ($this->isDataTableRequest()) {
            return $this->renderView('dashboard::resources.product.columns.productTags', compact('product'));
        }

        return $fallback;
    }
}
