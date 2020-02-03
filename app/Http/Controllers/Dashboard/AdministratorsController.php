<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\AdministratorRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\CompanyRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Administrator controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class AdministratorsController extends ResourceController
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
	protected $resource = 'administrator';

    /**
     * @var array
     */
    protected $with = [
        'role',
        'company',
    ];

	/**
	 * @var RoleRepository
	 */
	protected $roles;

	/**
	 * @var CompanyRepository
	 */
	protected $companies;

	/**
	 * @var array
	 */
	protected $editActionFormData = [
		'roles' => 'name',
		'companies' => 'name',
	];

	/**
	 * AdministratorsController constructor.
	 * @param Gate $gate
	 * @param AdministratorRepository $administratorRepository
	 * @param RoleRepository $roleRepository
	 * @param CompanyRepository $companyRepository
	 */
	public function __construct(
		Gate $gate,
		AdministratorRepository $administratorRepository,
		RoleRepository $roleRepository,
		CompanyRepository $companyRepository
	)
	{
		$this->gate = $gate;
		$this->repository = $administratorRepository;
		$this->roles = $roleRepository;
		$this->companies = $companyRepository;

		$this->middleware('auth:dashboard');
		$this->shareSidebar();
	}
}
