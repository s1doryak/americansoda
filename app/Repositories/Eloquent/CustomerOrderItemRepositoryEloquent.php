<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerOrderItemRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerOrderItemRepositoryEloquent extends BaseRepositoryEloquent implements CustomerOrderItemRepository {}