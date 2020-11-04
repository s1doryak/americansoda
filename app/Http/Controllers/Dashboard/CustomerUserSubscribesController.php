<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\CustomerUserSubscribeDataTable;
use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\CustomerUserSubscribeRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CustomerUserRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerUserSubscribe controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerUserSubscribesController extends \Crmplease\MaterialAdmin\Routing\ResourceController
{
    use DashboardSidebar;

	/**
	 * @var Gate
	 */
	protected $gate;

    /**
     * @var string
     */
	protected $defaultMiddleware = 'auth:dashboard';

    /**
     * @var string
     */
    protected $prefix = 'dashboard';

    /**
     * @var string
     */
    protected $resource = 'customer_user_subscribe';

    /**
     * @var string
     */
    protected $dataTable = CustomerUserSubscribeDataTable::class;

    /**
     * @var string
     */
    protected $translationPrefix = 'models/';

    /**
     * @var array
     */
    protected $with = [
		'product',
		'customerUser',
    ];


	/**
	 * @var ProductRepository
	 */
	protected $products;

	/**
	 * @var CustomerUserRepository
	 */
	protected $customerUsers;

	/**
	 * Popup windows. @see getPopupActions()
	 *
	 * Example:
	 *
	 *  'create',
	 *  'edit',
	 *
	 * or size specific:
	 *
	 *  'create' => 'large',
	 *  'edit' => 'fullscreen',
	 *
	 * or advanced configuration:
	 *
	 *  'create' => [
	 *      'resource' => 'user',
	 *      'title' => 'Custom Title',
	 *      'class' => 'modal-lg',
	 *  ],
	 *  'edit' => [
	 *      'resource' => 'user',
	 *      'title' => 'Custom Title',
	 *      'class' => 'modal-fluid',
	 *  ],
	 *
	 */
	protected $popupActions = [

	];

	/**
	 * Array describing additional data for the HTML 'create' form.
	 *
	 * Example:
	 *
	 * 'customer_orders' => [
	 *     'repository' => 'orders',
	 *     'lists' => 'number', // or 'lists' => ['number', 'id']
	 *     'selected' => 'order' // or 'selected' => ['order, 'id']
	 * ],
	 * 'employees' => [
	 *     'repository' => 'employees',
	 *     'lists' => 'name',
	 *     'selected' => 'employee'
	 * ]
	 *
	 * @var array
	 * @see mapFormDataConfigToAction()
	 */
	protected $createActionFormData = [
		'products' => 'name',
		'customerUsers' => 'name',
	];

	/**
	 * Array describing additional data for the HTML 'edit' form.
	 *
	 * @var array
	 */
	protected $editActionFormData = [
		'products' => 'name',
		'customerUsers' => 'name',
	];

	/**
	 * Custom editing actions. @see getEditingActions()
	 *
	 * @var array
	 */
	protected $editingActions = [

	];

	/**
	 * Custom editing actions. @see getPersistingActions()
	 *
	 * @var array
	 */
	protected $persistingActions = [

	];

	/**
	 * Additional view response data.
	 *
	 * @var array
	 */
	protected $defaultViewData = [

	];

    /**
     * CustomerUserSubscribesController constructor.
     * @param Gate $gate
	 * @param CustomerUserSubscribeRepository $CustomerUserSubscribeRepository
	 * @param ProductRepository $productRepository
	 * @param CustomerUserRepository $customerUserRepository
     * @return void
     */
	public function __construct(
        Gate $gate,
        CustomerUserSubscribeRepository $CustomerUserSubscribeRepository,
        ProductRepository $productRepository,
        CustomerUserRepository $customerUserRepository
	)
	{
	    parent::__construct();

	    $this->gate = $gate;
		$this->repository = $CustomerUserSubscribeRepository;
		$this->products = $productRepository;
		$this->customerUsers = $customerUserRepository;

		$this->shareSidebar();
	}
}
