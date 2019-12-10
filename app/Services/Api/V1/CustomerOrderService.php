<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\CustomerOrderRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class CustomerOrderService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(CustomerOrderRepositoryEloquent::class);
    }
}