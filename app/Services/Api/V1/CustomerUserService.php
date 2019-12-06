<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\CustomerUserRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\EntityService;

class CustomerUserService extends EntityService
{
    public function __construct()
    {
        $this->setRepository(CustomerUserRepositoryEloquent::class);
    }
}