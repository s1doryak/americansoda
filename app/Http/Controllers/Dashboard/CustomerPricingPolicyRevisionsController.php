<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerPricingPolicyRevisionRepository;
use App\Repositories\Contracts\CustomerPricingPolicyRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerPricingPolicyRevision controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerPricingPolicyRevisionsController extends ResourceController
{
	use DashboardSidebar;

	/**
	 * @var Gate
	 */
	protected $gate;

    /**
     * @var string
     */
    protected $prefix = 'dashboard';

    /**
     * @var string
     */
    protected $resource = 'customer_pricing_policy_revision';

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
	protected $editActionFormData = [
		'revisions' => 'name',
		'customerPricingPolicies' => 'name',
		'editors' => 'name',
		'productGroups' => 'name',
		'customers' => 'name',
	];

    /**
     * CustomerPricingPolicyRevisionsController constructor.
     * @param Gate $gate
	 * @param CustomerPricingPolicyRevisionRepository $customerPricingPolicyRevisionRepository
	 * @param CustomerPricingPolicyRepository $customerPricingPolicyRepository
	 * @param UserRepository $userRepository
	 * @param ProductGroupRepository $productGroupRepository
	 * @param CustomerRepository $customerRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerPricingPolicyRevisionRepository $customerPricingPolicyRevisionRepository,
		CustomerPricingPolicyRepository $customerPricingPolicyRepository,
		UserRepository $userRepository,
		ProductGroupRepository $productGroupRepository,
		CustomerRepository $customerRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerPricingPolicyRevisionRepository;
		$this->revisions = $customerPricingPolicyRevisionRepository;
		$this->customerPricingPolicies = $customerPricingPolicyRepository;
		$this->editors = $userRepository;
		$this->productGroups = $productGroupRepository;
		$this->customers = $customerRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
