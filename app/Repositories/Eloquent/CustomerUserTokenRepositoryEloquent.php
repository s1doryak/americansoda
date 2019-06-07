<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerUserTokenRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerUserTokenRepositoryEloquent extends BaseRepositoryEloquent implements CustomerUserTokenRepository {}