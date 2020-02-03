<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerTypeRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerType controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerTypesController extends ResourceController
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
    protected $resource = 'customer_type';

    /**
     * @var array
     */
    protected $with = [
        'customerType',
        'banners',
    ];

    /**
	 * @var CustomerTypeRepository
	 */
	protected $customerTypes;

    /**
     * @var array
     */
	protected $editActionFormData = [
		'customerTypes' => 'name',
	];

    /**
     * CustomerTypesController constructor.
     * @param Gate $gate
	 * @param CustomerTypeRepository $customerTypeRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerTypeRepository $customerTypeRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerTypeRepository;
		$this->customerTypes = $customerTypeRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
