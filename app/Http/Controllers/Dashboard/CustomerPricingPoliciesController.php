<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerPricingPolicyRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerPricingPolicy controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerPricingPoliciesController extends ResourceController
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
    protected $resource = 'customer_pricing_policy';

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
		'productGroups' => 'name',
		'customers' => 'name',
	];

    /**
     * CustomerPricingPoliciesController constructor.
     * @param Gate $gate
	 * @param CustomerPricingPolicyRepository $customerPricingPolicyRepository
	 * @param ProductGroupRepository $productGroupRepository
	 * @param CustomerRepository $customerRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerPricingPolicyRepository $customerPricingPolicyRepository,
		ProductGroupRepository $productGroupRepository,
		CustomerRepository $customerRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerPricingPolicyRepository;
		$this->productGroups = $productGroupRepository;
		$this->customers = $customerRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
