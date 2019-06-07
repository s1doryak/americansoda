<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerPreOrderItemRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerPreOrderItemRepositoryEloquent extends BaseRepositoryEloquent implements CustomerPreOrderItemRepository {}