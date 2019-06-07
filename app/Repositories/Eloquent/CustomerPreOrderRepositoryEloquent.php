<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerPreOrderRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerPreOrderRepositoryEloquent extends BaseRepositoryEloquent implements CustomerPreOrderRepository {}