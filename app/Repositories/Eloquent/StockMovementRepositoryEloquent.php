<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StockMovementRepository;
use App\StockMovement;

class StockMovementRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements StockMovementRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return StockMovement::class;
    }
}
