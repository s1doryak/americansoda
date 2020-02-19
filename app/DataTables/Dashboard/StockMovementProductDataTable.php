<?php

namespace App\DataTables\Dashboard;

use DB;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\StockMovementProduct;

/**
 * StockMovementProduct datatable.
 *
 * @package App\DataTables\Dashboard
 */
class StockMovementProductDataTable extends DataTable
{
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'stockMovement.stock.name' => [
                'name' => 'stockMovement.stock.name',
                'data' => 'stockMovement.stock.name',
                'searchable' => true,
                'orderable' => false,
            ],
            'product.name' => [
                'name' => 'product.name',
                'data' => 'product.name',
                'searchable' => true
            ],
            'formatted_products_quantity',
            'delivery_number' => [
                'searchable' => true
            ],
            'expiration_date',
            'movement_type' => [
                'searchable' => true
            ],
            'comment' => [
                'searchable' => true
            ],
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @return array
     */
    public function getRawColumns()
    {
        return [
            'name',
            'number',
            'comment',
            'formatted_products_quantity',
            'action',
            'stockMovement.stock.name'
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
            'stockMovement.stock.name' => [
                'name' => 'stockMovement.stock.name',
                'data' => 'stockMovement.stock.name',
                'type' => 'select',
                'multiple' => true,
            ],
            'product.name' => [
                'name' => 'product.name',
                'data' => 'product.name',
                'type' => 'select',
                'multiple' => true,
            ],
            'created_at' => [
                'type' => 'daterangepicker',
                'name' => 'created_at',
                'query' => function ($query, $filterColumn, $value) {

                    /** @var \Illuminate\Support\Collection $dates */
                    $dates = collect(explode(' - ', $value));

                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    $query->whereRaw(
                        DB::raw(
                            sprintf(
                                "%s BETWEEN STR_TO_DATE('%s', '%s') AND STR_TO_DATE('%s', '%s')",
                                $filterColumn,
                                $dates->first(),
                                '%d/%m/%Y',
                                $dates->last(),
                                '%d/%m/%Y'
                            )
                        )
                    );
                },
            ],
            'comment' => [
                'type' => 'daterangepicker',
                'name' => 'comment',
                'query' => function ($query, $filterColumn, $value) {

                    /** @var \Illuminate\Support\Collection $dates */
                    $dates = collect(explode(' - ', $value));

                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    $query->whereRaw(
                        DB::raw(sprintf("%s REGEXP '[0-9]{2}\.[0-9]{2}\.[0-9]{4}_.*'", $filterColumn))
                    )->whereRaw(
                        DB::raw(
                            sprintf(
                                "STR_TO_DATE(SUBSTRING(%s, 1, 10), '%s') BETWEEN STR_TO_DATE('%s', '%s') AND STR_TO_DATE('%s', '%s')",
                                $filterColumn,
                                '%d.%m.%Y',
                                $dates->first(),
                                '%d/%m/%Y',
                                $dates->last(),
                                '%d/%m/%Y'
                            )
                        )
                    );
                },
            ],
        ];
    }

    /**
     * @param StockMovementProduct $stockMovementProduct
     * @return array
     */
    protected function getActions($stockMovementProduct)
    {
        return parent::getActions($stockMovementProduct);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param StockMovementProduct $stockMovementProduct
     * @return string
     */
    public function renderStockMovement__Stock__NameColumn($stockMovementProduct)
    {
        if ($this->isDataTableRequest()) {
            return $stockMovementProduct->stockMovement->stock->name ?? $this->renderDefaultView();
        }

        return $stockMovementProduct->stockMovement->stock->name ?? null;
    }

    /**
     * @param StockMovementProduct $stockMovementProduct
     * @return string
     */
    public function renderProduct__NameColumn($stockMovementProduct)
    {
        if ($this->isDataTableRequest()) {
            return $stockMovementProduct->product->name ?? $this->renderDefaultView();
        }

        return $stockMovementProduct->product->name ?? null;
    }
}
