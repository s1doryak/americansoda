<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\FailedJobRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class FailedJobRepositoryEloquent extends BaseRepositoryEloquent implements FailedJobRepository {}