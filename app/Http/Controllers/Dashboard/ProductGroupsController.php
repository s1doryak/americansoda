<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\ProductGroupRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * ProductGroup controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class ProductGroupsController extends ResourceController
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
    protected $resource = 'product_group';



    /**
     * @var array
     */
	protected $editActionFormData = [

	];

    /**
     * ProductGroupsController constructor.
     * @param Gate $gate
	 * @param ProductGroupRepository $productGroupRepository
     */
	public function __construct(
	    Gate $gate,
		ProductGroupRepository $productGroupRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $productGroupRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
