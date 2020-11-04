<?php

namespace App\Repositories\Eloquent;

use App\AuthLog;
use App\Repositories\Contracts\AuthLogRepository;

/**
 * Class AuthLogRepositoryEloquent
 * @package App\Repositories\Eloquent
 */
class AuthLogRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements AuthLogRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return AuthLog::class;
    }
}
