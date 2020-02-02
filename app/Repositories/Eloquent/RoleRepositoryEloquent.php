<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepository;
use App\Role;

class RoleRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements RoleRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Role::class;
    }
}
