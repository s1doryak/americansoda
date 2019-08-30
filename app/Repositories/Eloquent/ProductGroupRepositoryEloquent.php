<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductGroupRepository;

class ProductGroupRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements ProductGroupRepository
{
	/**
	 * @param $id
	 * @return mixed
	 */
	public function getGroupsByCustomerId($id)
	{
		$criteria = function ($query) use ($id) {
			/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
			$query->where('customer_pricing_policies.customer_id', $id)->orderBy('products_range');
		};

		return $this->with(['pricingPolicies' => $criteria])->all();
	}
}
