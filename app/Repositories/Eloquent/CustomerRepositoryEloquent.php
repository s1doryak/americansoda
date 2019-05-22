<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerRepositoryEloquent extends BaseRepositoryEloquent implements CustomerRepository {}