<?php

namespace App\Console\Commands\Resources;

use App\CustomerPricingPolicy;
use App\Repositories\Contracts\CustomerPricingPolicyRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use App\Repositories\Contracts\CustomerRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerPricingPolicy resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerPricingPolicyCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_pricing_policy';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_pricing_policy';

    /**
     * @var string
     */
    protected $action = 'store';
	/**
	 * @var ProductGroupRepository
	 */
	protected $productGroups;

	/**
	 * @var CustomerRepository
	 */
	protected $customers;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'productGroups' => 'name',
		'customers' => 'name',
	];

	public function __construct(
	    CustomerPricingPolicy $customerPricingPolicy,
		CustomerPricingPolicyRepository $customerPricingPolicyRepository,
		ProductGroupRepository $productGroupRepository,
		CustomerRepository $customerRepository
	)
	{
	    $this->model = $customerPricingPolicy;
		$this->repository = $customerPricingPolicyRepository;
		$this->productGroups = $productGroupRepository;
		$this->customers = $customerRepository;

        parent::__construct();
	}

	/**
	 * @param CustomerPricingPolicy $customer_pricing_policy
	 * @return array
	 */
	public function getEventAttributes($customer_pricing_policy)
	{
		return $customer_pricing_policy->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
