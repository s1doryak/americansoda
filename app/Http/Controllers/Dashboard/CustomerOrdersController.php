<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerOrder controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerOrdersController extends ResourceController
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
    protected $resource = 'customer_order';

	/**
	 * @var CustomerRepository
	 */
	protected $customers;
	
	/**
	 * @var UserRepository
	 */
	protected $users;
	

    /**
     * @var array
     */
	protected $editActionFormData = [
		'customers' => 'name',
		'users' => 'name',
	];

    /**
     * CustomerOrdersController constructor.
     * @param Gate $gate
	 * @param CustomerOrderRepository $customerOrderRepository
	 * @param CustomerRepository $customerRepository
	 * @param UserRepository $userRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerOrderRepository $customerOrderRepository,
		CustomerRepository $customerRepository,
		UserRepository $userRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerOrderRepository;
		$this->customers = $customerRepository;
		$this->users = $userRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
