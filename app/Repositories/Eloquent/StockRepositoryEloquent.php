<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StockRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class StockRepositoryEloquent extends BaseRepositoryEloquent implements StockRepository {}