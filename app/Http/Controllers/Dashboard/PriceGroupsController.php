<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\PriceGroupRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * PriceGroup controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class PriceGroupsController extends ResourceController
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
    protected $resource = 'price_group';

    /**
     * @var array
     */
    protected $with = [
        'priceGroupBreakpoints',
        'priceGroupBreakpoints.productGroups'
    ];

    /**
     * @var array
     */
	protected $editActionFormData = [

	];

    /**
     * @var array
     */
    protected $popupActions = [
        'create' => 'large',
        'edit' => 'large'
    ];

    /**
     * PriceGroupsController constructor.
     * @param Gate $gate
	 * @param PriceGroupRepository $priceGroupRepository
     */
	public function __construct(
	    Gate $gate,
		PriceGroupRepository $priceGroupRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $priceGroupRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
