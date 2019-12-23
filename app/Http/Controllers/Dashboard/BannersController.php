<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\BannerRepository;
use App\Repositories\Contracts\CustomerTypeRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Banner controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class BannersController extends \Crmplease\MaterialAdmin\Routing\ResourceController
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
    protected $resource = 'banner';

    /**
     * @var array
     */
    protected $with = [
        'customerTypes',
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
     * BannersController constructor.
     * @param Gate $gate
	 * @param BannerRepository $bannerRepository
	 * @param CustomerTypeRepository $customerTypeRepository
     * @return void
     */
	public function __construct(
	    Gate $gate,
		BannerRepository $bannerRepository,
		CustomerTypeRepository $customerTypeRepository
	)
	{
	    parent::__construct();

	    $this->gate = $gate;
		$this->repository = $bannerRepository;
		$this->customerTypes = $customerTypeRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
