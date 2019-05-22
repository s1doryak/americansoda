<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class ProductRepositoryEloquent extends BaseRepositoryEloquent implements ProductRepository {}