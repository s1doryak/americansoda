<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\ProductTypeRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class ProductTypeService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(ProductTypeRepositoryEloquent::class);
    }
}