<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerPreOrderRepository;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerPreOrder controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerPreOrdersController extends ResourceController
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
    protected $resource = 'customer_pre_order';


	/**
	 * @var CustomerUserRepository
	 */
	protected $customerUsers;

	/**
	 * @var CustomerOrderRepository
	 */
	protected $customerOrders;

	/**
	 * @var CustomerRepository
	 */
	protected $customers;

    /**
     * @var array
     */
	protected $editActionFormData = [
		'customerUsers' => 'name',
		'customerOrders' => 'number',
		'customers' => 'name',
	];

    /**
     * CustomerPreOrdersController constructor.
     * @param Gate $gate
	 * @param CustomerPreOrderRepository $customerPreOrderRepository
	 * @param CustomerUserRepository $customerUserRepository
	 * @param CustomerOrderRepository $customerOrderRepository
	 * @param CustomerRepository $customerRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerPreOrderRepository $customerPreOrderRepository,
		CustomerUserRepository $customerUserRepository,
		CustomerOrderRepository $customerOrderRepository,
		CustomerRepository $customerRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerPreOrderRepository;
		$this->customerUsers = $customerUserRepository;
		$this->customerOrders = $customerOrderRepository;
		$this->customers = $customerRepository;

	    $this->middleware('auth:dashboard');
        $this->shareSidebar();
	}
}
