<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerUserRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerUserRepositoryEloquent extends BaseRepositoryEloquent implements CustomerUserRepository {}