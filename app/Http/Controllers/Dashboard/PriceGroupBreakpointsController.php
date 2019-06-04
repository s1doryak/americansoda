<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\PriceGroupBreakpointRepository;
use App\Repositories\Contracts\PriceGroupRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * PriceGroupBreakpoint controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class PriceGroupBreakpointsController extends ResourceController
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
    protected $resource = 'price_group_breakpoint';
	
	/**
	 * @var PriceGroupRepository
	 */
	protected $priceGroups;
	
	/**
	 * @var ProductGroupRepository
	 */
	protected $productGroups;

    /**
     * @var array
     */
	protected $editActionFormData = [
		'priceGroups' => 'name',
		'productGroups' => 'name',
	];

    /**
     * PriceGroupBreakpointsController constructor.
     * @param Gate $gate
	 * @param PriceGroupBreakpointRepository $priceGroupBreakpointRepository
	 * @param PriceGroupRepository $priceGroupRepository
	 * @param ProductGroupRepository $productGroupRepository
     */
	public function __construct(
	    Gate $gate,
		PriceGroupBreakpointRepository $priceGroupBreakpointRepository,
		PriceGroupRepository $priceGroupRepository,
		ProductGroupRepository $productGroupRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $priceGroupBreakpointRepository;
		$this->priceGroups = $priceGroupRepository;
		$this->productGroups = $productGroupRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
