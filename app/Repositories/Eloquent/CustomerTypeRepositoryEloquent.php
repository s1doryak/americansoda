<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerTypeRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerTypeRepositoryEloquent extends BaseRepositoryEloquent implements CustomerTypeRepository {}