<?php

namespace App\Repositories\Eloquent;

use App\Job;
use App\Repositories\Contracts\JobRepository;

class JobRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements JobRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Job::class;
    }
}
