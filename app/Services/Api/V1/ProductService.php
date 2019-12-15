<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\ProductRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class ProductService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(ProductRepositoryEloquent::class);
    }
}