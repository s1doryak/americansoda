<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Contracts\RegionRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Company controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CompaniesController extends ResourceController
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
    protected $resource = 'company';

    /**
     * @var array
     */
    protected $with = [
        'region',
        'companyBankAccounts',
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
     * CompaniesController constructor.
     * @param Gate $gate
	 * @param CompanyRepository $companyRepository
	 * @param RegionRepository $regionRepository
     */
	public function __construct(
	    Gate $gate,
		CompanyRepository $companyRepository,
		RegionRepository $regionRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $companyRepository;
		$this->regions = $regionRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
