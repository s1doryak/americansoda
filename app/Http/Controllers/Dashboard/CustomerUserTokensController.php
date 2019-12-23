<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerUserTokenRepository;
use App\Repositories\Contracts\CustomerUserRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerUserToken controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerUserTokensController extends ResourceController
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
    protected $resource = 'customer_user_token';


	/**
	 * @var CustomerUserRepository
	 */
	protected $customerUsers;

    /**
     * @var array
     */
	protected $editActionFormData = [
		'customerUsers' => 'name',
	];

    /**
     * CustomerUserTokensController constructor.
     * @param Gate $gate
	 * @param CustomerUserTokenRepository $customerUserTokenRepository
	 * @param CustomerUserRepository $customerUserRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerUserTokenRepository $customerUserTokenRepository,
		CustomerUserRepository $customerUserRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerUserTokenRepository;
		$this->customerUsers = $customerUserRepository;

	    $this->middleware('auth:dashboard');
        $this->shareSidebar();
	}
}
