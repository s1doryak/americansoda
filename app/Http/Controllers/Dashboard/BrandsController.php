<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\BrandRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Brand controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class BrandsController extends ResourceController
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
	protected $resource = 'brand';


	/**
	 * @var array
	 */
	protected $editActionFormData = [

	];

	/**
	 * BrandsController constructor.
	 * @param Gate $gate
	 * @param BrandRepository $brandRepository
	 */
	public function __construct(
		Gate $gate,
		BrandRepository $brandRepository
	)
	{
		$this->gate = $gate;
		$this->repository = $brandRepository;

		$this->middleware('dashboard');
		$this->shareSidebar();
	}
}
