<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\BannerRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\EntityService;

class BannerService extends EntityService
{
    protected $customerUserService;

    public function __construct()
    {
        $this->setRepository(BannerRepositoryEloquent::class);
    }
}