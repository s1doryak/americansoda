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
    protected $name = 'resource:create:customer_pricing_policy';

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
	    $this->resource = $customerPricingPolicy;
		$this->repository = $customerPricingPolicyRepository;
		$this->productGroups = $productGroupRepository;
		$this->customers = $customerRepository;

        parent::__construct();
	}

	/**
	 * @return string
	 */
	public function getEventNamespace()
	{
		return 'cli';
	}

	/**
	 * @return string
	 */
	public function getEventResource()
	{
		return 'customer_pricing_policy';
	}

    /**
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
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
