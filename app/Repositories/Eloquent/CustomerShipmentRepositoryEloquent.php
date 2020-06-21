<?php

namespace App\Repositories\Eloquent;

use App\CustomerShipment;
use DB;
use App\Repositories\Contracts\CustomerShipmentRepository;

class CustomerShipmentRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerShipmentRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerShipment::class;
    }

    /**
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|null $query
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function getDatatablesQuery($query = null)
	{
		/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
		$query = parent::getDatatablesQuery($query);

		$query->addSelect(
			DB::raw('concat(left(number, 4), right(number, 4)) as delivery_date')
		);

		return $query;
	}

    public function getByShopId($shopId)
    {
        return $this
            ->with('customerInvoice')
            ->orderBy(DB::raw('number', 'SOUNDEX(number) $1, LENGTH(number) $1, number $1'), 'desc')
            ->findWhere(['customer_id' => $shopId]);
    }
}
