<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StockProductRepository;

class StockProductRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements StockProductRepository
{
	/**
	 * @param $stockId
	 * @param $item
	 * @return mixed
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 */
	public function countAvailableForItem($stockId, $item)
	{
		/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
		$query = $this->model
			->select()
			->where('stock_id', '=', $stockId)
			->where('product_id', '=', $item->product->id)
			->where(function ($q) use ($item) {
				/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $q */
				$q->where('customer_order_item_id', '=', null)->orWhere('customer_order_item_id', '=', $item->id);
			})
			->orderBy('expiration_date')
			->orderBy('created_at');

		$this->resetModel();

		return $this->parserResult($query->count());
	}

	/**
	 * @param $stockId
	 * @param $item
	 * @return mixed
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 */
	public function findAssembledProducts($stockId, $item)
	{
		/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
		$query = $this->model
			->select()
			->where('stock_id', '=', $stockId)
			->where('product_id', '=', $item->product->id)
			->where('customer_order_item_id', '=', $item->id)
			->orderBy('expiration_date')
			->orderBy('created_at');

		$this->resetModel();

		return $this->parserResult($query->get());
	}

	/**
	 * @param $stockId
	 * @param $productId
	 * @param $quantity
	 * @return mixed
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 */
	public function findAvailableProducts($stockId, $productId, $quantity)
	{
		/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
		$query = $this->model
			->select()
			->where('stock_id', '=', $stockId)
			->where('product_id', '=', $productId)
			->where('customer_order_item_id', '=', null)
			->orderBy('expiration_date')
			->orderBy('created_at')
			->take($quantity);

		$this->resetModel();

		return $this->parserResult($query->get());
	}

	/**
	 * @param $ids
	 * @param $itemId
	 * @return mixed
	 */
	public function reserveProducts($ids, $itemId)
	{
		return $this->model
			->whereIn('id', $ids)
			->update([
				'customer_order_item_id' => $itemId
			]);
	}

	/**
	 * @param $ids
	 * @return mixed
	 */
	public function freeProducts($ids)
	{
		return $this->model
			->whereIn('id', $ids)
			->update([
				'customer_order_item_id' => null
			]);
	}

	/**
	 * @param $ids
	 * @return mixed
	 */
	public function trashProducts($ids)
	{
		return $this->model
			->whereIn('id', $ids)
			->forceDelete();
	}
}
