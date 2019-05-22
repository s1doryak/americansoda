<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerRevisionRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerRevisionRepositoryEloquent extends BaseRepositoryEloquent implements CustomerRevisionRepository {}