<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\JobRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class JobRepositoryEloquent extends BaseRepositoryEloquent implements JobRepository {}