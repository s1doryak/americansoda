<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerPreOrderRepository;
use DB;

class CustomerPreOrderRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerPreOrderRepository
{
    public function getByShopId($shopId)
    {
        return $this
            ->orderBy(DB::raw('number', 'SOUNDEX(number) $1, LENGTH(number) $1, number $1'))
            ->findWhere(['customer_id' => $shopId]);
    }
}
