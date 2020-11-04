<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\SettingRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class SettingService extends ResourceService
{
    public function __construct(SettingRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }
}
