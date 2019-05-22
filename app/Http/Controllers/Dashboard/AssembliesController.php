<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\AssemblyRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Assembly controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class AssembliesController extends ResourceController
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
    protected $resource = 'assembly';



    /**
     * @var array
     */
	protected $editActionFormData = [

	];

    /**
     * AssembliesController constructor.
     * @param Gate $gate
	 * @param AssemblyRepository $assemblyRepository
     */
	public function __construct(
	    Gate $gate,
		AssemblyRepository $assemblyRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $assemblyRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
