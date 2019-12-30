<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\CustomerPricingPolicyRepository;
use App\Repositories\Eloquent\CustomerPricingPolicyRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class CustomerPricingPolicyService extends ResourceService
{
    /**
     * @var CustomerPricingPolicyRepositoryEloquent
     */
    protected $repository;

    public function __construct()
    {
        $this->setRepository(CustomerPricingPolicyRepository::class);
    }
}
