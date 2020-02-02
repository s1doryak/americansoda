<?php

namespace App\Repositories\Eloquent;

use App\CustomerPreOrderItem;
use App\Repositories\Contracts\CustomerPreOrderItemRepository;

class CustomerPreOrderItemRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerPreOrderItemRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerPreOrderItem::class;
    }
}
