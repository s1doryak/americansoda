<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepository;
use App\User;

class UserRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements UserRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
