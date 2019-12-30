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

    /**
     * CustomerPricingPolicyService constructor.
     * @param CustomerPricingPolicyRepository $repository
     */
    public function __construct(
        CustomerPricingPolicyRepository $repository
    )
    {
        $this->repository = $repository;
    }
}
