<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\RoleRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Role controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class RolesController extends ResourceController
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
	protected $resource = 'role';


	/**
	 * @var array
	 */
	protected $editActionFormData = [

	];

	/**
	 * RolesController constructor.
	 * @param Gate $gate
	 * @param RoleRepository $roleRepository
	 */
	public function __construct(
		Gate $gate,
		RoleRepository $roleRepository
	)
	{
		$this->gate = $gate;
		$this->repository = $roleRepository;

		$this->middleware('auth:dashboard');
		$this->shareSidebar();
	}
}
