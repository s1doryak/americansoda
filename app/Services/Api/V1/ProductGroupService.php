<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\ProductGroupRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class ProductGroupService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(ProductGroupRepositoryEloquent::class);
    }
}