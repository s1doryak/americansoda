<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StockRepository;
use App\Stock;

class StockRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements StockRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Stock::class;
    }
}
