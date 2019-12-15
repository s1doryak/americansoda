<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\CustomerOrderItemRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class CustomerOrderItemService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(CustomerOrderItemRepositoryEloquent::class);
    }
}