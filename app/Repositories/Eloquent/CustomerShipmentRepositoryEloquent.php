<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Repositories\Contracts\CustomerShipmentRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Builder;

class CustomerShipmentRepositoryEloquent extends BaseRepositoryEloquent implements CustomerShipmentRepository
{
	/**
	 * @param Builder $builder
	 *
	 * @return Builder
	 */
	public function getDatatablesQuery(Builder $query = null)
	{
		/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
		$query = parent::getDatatablesQuery($query);

		$query->addSelect(
			DB::raw('concat(left(number, 4), right(number, 4)) as delivery_date')
		);

		return $query;
	}
}