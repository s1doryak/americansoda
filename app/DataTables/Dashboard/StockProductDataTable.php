<?php

namespace App\DataTables\Dashboard;

use DB;
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
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
        $query = $this->repository->getDatatablesQuery()
            ->addSelect(
                DB::raw('count(product_id) as `total`')
            )
            ->addSelect(
                DB::raw(
                    'sum(case when customer_order_item_id is null then 0 else 1 end) as `reserved`'
                )
            )
            ->addSelect(
                DB::raw(
                    '(count(product_id) - sum(case when customer_order_item_id is null then 0 else 1 end)) as `available`'
                )
            )
            ->groupBy('stock_id')
            ->groupBy('product_id')
            ->groupBy('delivery_number');

        return $this->applyScopes($query);
    }

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'stock.name' => [
                'name' => 'stock.name',
                'data' => 'stock.name',
                'searchable' => true,
                'orderable' => false
            ],
            'product.name' => [
                'name' => 'product.name',
                'data' => 'product.name',
                'searchable' => true
            ],
            'product.productGroup.name' => [
                'data' => 'product.productGroup.name',
                'name' => 'product.productGroup.name',
                'searchable' => true,
            ],
            'delivery_number' => [
                'searchable' => true
            ],
            'expiration_date',
            'total',
            'reserved',
            'available',
        ];
    }

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
            'total' => [
                'format' => '%d',
            ],
            'reserved' => [
                'format' => '%d',
            ],
            'available' => [
                'format' => '%d',
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
            'stock.name' => [
                'name' => 'stock.name',
                'data' => 'stock.id',
                'type' => 'select',
                'multiple' => true,
            ],
            'delivery_number' => [
                'name' => 'delivery_number',
                'data' => 'delivery_number',
            ],
            'product.name' => [
                'name' => 'product.name',
                'data' => 'product.id',
                'type' => 'select',
                'multiple' => true,
            ],
            'product.productGroup.name' => [
                'data' => 'product.productGroup.id',
                'name' => 'product.productGroup.name',
                'type' => 'select',
                'multiple' => true,
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

    /**
     * @param StockProduct $stockProduct
     * @return string
     */
    public function renderProduct__NameColumn($stockProduct)
    {
        if ($this->isDataTableRequest()) {
            return $stockProduct->product->name ?? $this->renderDefaultView();
        }

        return $stockProduct->product->name;
    }

    /**
     * @param StockProduct $stockProduct
     * @return string
     */
    public function renderStock__NameColumn($stockProduct)
    {
        if ($this->isDataTableRequest()) {
            return $stockProduct->stock->name ?? $this->renderDefaultView();
        }

        return $stockProduct->stock->name;
    }

    /**
     * @param StockProduct $stockProduct
     * @return string
     */
    public function renderProduct__ProductGroup__NameColumn($stockProduct)
    {
        if ($this->isDataTableRequest()) {
            return $stockProduct->product->productGroup->name ?? $this->renderDefaultView();
        }

        return $stockProduct->product->productGroup->name;
    }
}
