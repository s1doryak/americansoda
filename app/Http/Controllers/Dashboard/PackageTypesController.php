<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\PackageTypeRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * PackageType controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class PackageTypesController extends ResourceController
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
	protected $resource = 'package_type';


	/**
	 * @var array
	 */
	protected $editActionFormData = [

	];

	/**
	 * PackageTypesController constructor.
	 * @param Gate $gate
	 * @param PackageTypeRepository $packageTypeRepository
	 */
	public function __construct(
		Gate $gate,
		PackageTypeRepository $packageTypeRepository
	)
	{
		$this->gate = $gate;
		$this->repository = $packageTypeRepository;

		$this->middleware('dashboard');
		$this->shareSidebar();
	}
}
