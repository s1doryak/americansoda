<?php

namespace App\Repositories\Eloquent;

use App\FailedJob;
use App\Repositories\Contracts\FailedJobRepository;

class FailedJobRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements FailedJobRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return FailedJob::class;
    }
}
