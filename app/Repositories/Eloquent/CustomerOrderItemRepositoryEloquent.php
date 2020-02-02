<?php

namespace App\Repositories\Eloquent;

use App\CustomerOrderItem;
use App\Repositories\Contracts\CustomerOrderItemRepository;

class CustomerOrderItemRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerOrderItemRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerOrderItem::class;
    }

	/**
	 * Find all order items (including trashed) by order id.
	 *
	 * @param int $id
	 *
	 * @return mixed
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 */
	public function findAllByOrderId($id)
	{
		$this->applyCriteria();
		$this->applyScope();

		$result = $this->model->whereNotNull('product_id')->where('customer_order_id', $id)->withTrashed()->get();

		$this->resetModel();

		return $this->parserResult($result);
	}

	/**
	 * Find all active order items by order id.
	 *
	 * @param $id
	 *
	 * @return mixed
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 */
	public function findActiveByOrderId($id)
	{
		$this->applyCriteria();
		$this->applyScope();

		$result = $this->model->whereNotNull('product_id')->where('customer_order_id', $id)->get();

		$this->resetModel();

		return $this->parserResult($result);
	}
}
