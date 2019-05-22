<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StockProductRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class StockProductRepositoryEloquent extends BaseRepositoryEloquent implements StockProductRepository {}