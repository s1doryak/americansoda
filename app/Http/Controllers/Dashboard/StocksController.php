<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\RegionRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Stock controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class StocksController extends ResourceController
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
    protected $resource = 'stock';

    /**
     * @var array
     */
    protected $with = [
        'region',
    ];

	/**
	 * @var RegionRepository
	 */
	protected $regions;

    /**
     * @var array
     */
	protected $editActionFormData = [
		'regions' => 'name',
	];

    /**
     * StocksController constructor.
     * @param Gate $gate
	 * @param StockRepository $stockRepository
	 * @param RegionRepository $regionRepository
     */
	public function __construct(
	    Gate $gate,
		StockRepository $stockRepository,
		RegionRepository $regionRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $stockRepository;
		$this->regions = $regionRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
