<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StockMovementProductRepository;
use App\StockMovementProduct;

class StockMovementProductRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements StockMovementProductRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return StockMovementProduct::class;
    }
}
