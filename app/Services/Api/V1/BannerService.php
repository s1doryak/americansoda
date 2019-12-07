<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\BannerRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class BannerService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(BannerRepositoryEloquent::class);
    }
}