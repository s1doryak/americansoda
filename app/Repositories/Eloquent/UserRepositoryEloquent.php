<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository {}