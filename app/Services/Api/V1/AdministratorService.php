<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\AdministratorRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class AdministratorService extends ResourceService
{
    /**
     * AdministratorService constructor.
     * @param AdministratorRepositoryEloquent $repository
     */
    public function __construct(
        AdministratorRepositoryEloquent $repository
    )
    {
        $this->repository = $repository;
    }
}