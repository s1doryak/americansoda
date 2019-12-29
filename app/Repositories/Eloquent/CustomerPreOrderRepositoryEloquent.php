<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerPreOrderRepository;
use DB;

class CustomerPreOrderRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerPreOrderRepository
{
    public function getByShopId($shopId, $withoutOrders = false)
    {
        $where = ['customer_id' => $shopId];

        if ($withoutOrders) {
            $where['customer_order_id'] = null;
        }

        return $this
            ->orderBy(DB::raw('number', 'SOUNDEX(number) $1, LENGTH(number) $1, number $1'))
            ->findWhere($where);
    }
}
