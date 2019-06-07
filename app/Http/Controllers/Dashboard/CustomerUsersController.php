<?php

namespace App\Http\Controllers\Dashboard;

use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerUser controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerUsersController extends ResourceController
{
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
    protected $resource = 'customer_user';

	
	/**
	 * @var CustomerRepository
	 */
	protected $customers;

    /**
     * @var array
     */
	protected $editActionFormData = [
		'customers' => 'name',
	];

    /**
     * CustomerUsersController constructor.
     * @param Gate $gate
	 * @param CustomerUserRepository $customerUserRepository
	 * @param CustomerRepository $customerRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerUserRepository $customerUserRepository,
		CustomerRepository $customerRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerUserRepository;
		$this->customers = $customerRepository;

	    $this->middleware('auth:dashboard');
	}
}
