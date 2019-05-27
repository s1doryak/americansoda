<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\RegionRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Region controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class RegionsController extends ResourceController
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
    protected $resource = 'region';



    /**
     * @var array
     */
	protected $editActionFormData = [

	];

    /**
     * RegionsController constructor.
     * @param Gate $gate
	 * @param RegionRepository $regionRepository
     */
	public function __construct(
	    Gate $gate,
		RegionRepository $regionRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $regionRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
