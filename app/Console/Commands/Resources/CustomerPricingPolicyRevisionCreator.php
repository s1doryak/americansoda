<?php

namespace App\Console\Commands\Resources;

use App\CustomerPricingPolicyRevision;
use App\Repositories\Contracts\CustomerPricingPolicyRevisionRepository;
use App\Repositories\Contracts\CustomerPricingPolicyRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use App\Repositories\Contracts\CustomerRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerPricingPolicyRevision resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerPricingPolicyRevisionCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_pricing_policy_revision';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_pricing_policy_revision';

    /**
     * @var string
     */
    protected $action = 'store';

	/**
	 * @var CustomerPricingPolicyRevisionRepository
	 */
	protected $revisions;

	/**
	 * @var CustomerPricingPolicyRepository
	 */
	protected $customerPricingPolicies;

	/**
	 * @var UserRepository
	 */
	protected $editors;

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
		'revisions' => 'name',
		'customerPricingPolicies' => 'name',
		'editors' => 'name',
		'productGroups' => 'name',
		'customers' => 'name',
	];

	public function __construct(
	    CustomerPricingPolicyRevision $customerPricingPolicyRevision,
		CustomerPricingPolicyRevisionRepository $customerPricingPolicyRevisionRepository,
		CustomerPricingPolicyRepository $customerPricingPolicyRepository,
		UserRepository $userRepository,
		ProductGroupRepository $productGroupRepository,
		CustomerRepository $customerRepository
	)
	{
	    $this->model = $customerPricingPolicyRevision;
		$this->repository = $customerPricingPolicyRevisionRepository;
		$this->revisions = $customerPricingPolicyRevisionRepository;
		$this->customerPricingPolicies = $customerPricingPolicyRepository;
		$this->editors = $userRepository;
		$this->productGroups = $productGroupRepository;
		$this->customers = $customerRepository;

        parent::__construct();
	}

	/**
	 * @param CustomerPricingPolicyRevision $customer_pricing_policy_revision
	 * @return array
	 */
	public function getEventAttributes($customer_pricing_policy_revision)
	{
		return $customer_pricing_policy_revision->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
