<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\CompanyRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * User controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class UsersController extends ResourceController
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
    protected $resource = 'user';

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
     * UsersController constructor.
     * @param Gate $gate
	 * @param UserRepository $userRepository
	 * @param RoleRepository $roleRepository
	 * @param CompanyRepository $companyRepository
     */
	public function __construct(
	    Gate $gate,
		UserRepository $userRepository,
		RoleRepository $roleRepository,
		CompanyRepository $companyRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $userRepository;
		$this->roles = $roleRepository;
		$this->companies = $companyRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
