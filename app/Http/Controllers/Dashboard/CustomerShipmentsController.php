<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\PackageTypeRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerShipment controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerShipmentsController extends ResourceController
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
    protected $resource = 'customer_shipment';

	/**
	 * @var PackageTypeRepository
	 */
	protected $packageTypes;
	
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
		'packageTypes' => 'name',
		'customers' => 'name',
		'users' => 'name',
	];

    /**
     * CustomerShipmentsController constructor.
     * @param Gate $gate
	 * @param CustomerShipmentRepository $customerShipmentRepository
	 * @param PackageTypeRepository $packageTypeRepository
	 * @param CustomerRepository $customerRepository
	 * @param UserRepository $userRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerShipmentRepository $customerShipmentRepository,
		PackageTypeRepository $packageTypeRepository,
		CustomerRepository $customerRepository,
		UserRepository $userRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerShipmentRepository;
		$this->packageTypes = $packageTypeRepository;
		$this->customers = $customerRepository;
		$this->users = $userRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
