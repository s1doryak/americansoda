<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerOrderRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerOrderRepositoryEloquent extends BaseRepositoryEloquent implements CustomerOrderRepository {}