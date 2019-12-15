<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\CustomerPricingPolicyRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class CustomerPricingPolicyService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(CustomerPricingPolicyRepositoryEloquent::class);
    }
}