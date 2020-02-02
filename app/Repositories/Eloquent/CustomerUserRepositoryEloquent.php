<?php

namespace App\Repositories\Eloquent;

use App\CustomerUser;
use App\Repositories\Contracts\CustomerUserRepository;

class CustomerUserRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerUserRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerUser::class;
    }
}
