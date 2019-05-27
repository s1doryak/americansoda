<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StockMovementProductRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Builder;

class StockMovementProductRepositoryEloquent extends BaseRepositoryEloquent implements StockMovementProductRepository
{
	/**
	 * @param Builder|null $query
	 * @return Builder
	 */
	public function getDatatablesQuery(Builder $query = null)
	{
		if (is_null($query)) {
			$query = $this->model->newQuery()->select();
		}

		$query
			->addSelect('stocks.name as stock_name')
			->addSelect('supplier_orders.number as supplier_order_number')
			->join('stock_movements', 'stock_movement_products.stock_movement_id', '=', 'stock_movements.id')
			->join('stocks', 'stock_movements.stock_id', '=', 'stocks.id')
			->leftJoin('supplier_orders', 'stock_movements.supplier_order_id', '=', 'supplier_orders.id');

		return $query;
	}
}