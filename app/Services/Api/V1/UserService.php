<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\UserRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class UserService extends ResourceService
{
    /**
     * UserService constructor.
     * @param UserRepositoryEloquent $repository
     */
    public function __construct(
        UserRepositoryEloquent $repository
    )
    {
        $this->repository = $repository;
    }
}
