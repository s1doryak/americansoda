<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\CustomerTypeRepository;
use App\Repositories\Contracts\PaymentTypeRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\RegionRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Customer controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomersController extends ResourceController
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
    protected $resource = 'customer';

	/**
	 * @var StockRepository
	 */
	protected $stocks;
	
	/**
	 * @var CustomerTypeRepository
	 */
	protected $customerTypes;
	
	/**
	 * @var PaymentTypeRepository
	 */
	protected $paymentTypes;
	
	/**
	 * @var UserRepository
	 */
	protected $users;
	
	/**
	 * @var RegionRepository
	 */
	protected $billingRegions;
	
	/**
	 * @var RegionRepository
	 */
	protected $shippingRegions;
	

    /**
     * @var array
     */
	protected $editActionFormData = [
		'stocks' => 'name',
		'customerTypes' => 'name',
		'paymentTypes' => 'name',
		'users' => 'name',
		'billingRegions' => 'name',
		'shippingRegions' => 'name',
	];

    /**
     * CustomersController constructor.
     * @param Gate $gate
	 * @param CustomerRepository $customerRepository
	 * @param StockRepository $stockRepository
	 * @param CustomerTypeRepository $customerTypeRepository
	 * @param PaymentTypeRepository $paymentTypeRepository
	 * @param UserRepository $userRepository
	 * @param RegionRepository $regionRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerRepository $customerRepository,
		StockRepository $stockRepository,
		CustomerTypeRepository $customerTypeRepository,
		PaymentTypeRepository $paymentTypeRepository,
		UserRepository $userRepository,
		RegionRepository $regionRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerRepository;
		$this->stocks = $stockRepository;
		$this->customerTypes = $customerTypeRepository;
		$this->paymentTypes = $paymentTypeRepository;
		$this->users = $userRepository;
		$this->billingRegions = $regionRepository;
		$this->shippingRegions = $regionRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
