<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerRevisionRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\CustomerTypeRepository;
use App\Repositories\Contracts\PaymentTypeRepository;
use App\Repositories\Contracts\RegionRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerRevision controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerRevisionsController extends ResourceController
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
    protected $resource = 'customer_revision';

	/**
	 * @var CustomerRevisionRepository
	 */
	protected $revisions;
	
	/**
	 * @var UserRepository
	 */
	protected $editors;
	
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
		'revisions' => 'name',
		'editors' => 'name',
		'stocks' => 'name',
		'customerTypes' => 'name',
		'paymentTypes' => 'name',
		'users' => 'name',
		'billingRegions' => 'name',
		'shippingRegions' => 'name',
	];

    /**
     * CustomerRevisionsController constructor.
     * @param Gate $gate
	 * @param CustomerRevisionRepository $customerRevisionRepository
	 * @param UserRepository $userRepository
	 * @param StockRepository $stockRepository
	 * @param CustomerTypeRepository $customerTypeRepository
	 * @param PaymentTypeRepository $paymentTypeRepository
	 * @param RegionRepository $regionRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerRevisionRepository $customerRevisionRepository,
		UserRepository $userRepository,
		StockRepository $stockRepository,
		CustomerTypeRepository $customerTypeRepository,
		PaymentTypeRepository $paymentTypeRepository,
		RegionRepository $regionRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerRevisionRepository;
		$this->revisions = $customerRevisionRepository;
		$this->editors = $userRepository;
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
