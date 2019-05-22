<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StockMovementRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class StockMovementRepositoryEloquent extends BaseRepositoryEloquent implements StockMovementRepository {}