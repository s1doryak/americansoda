<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\JobRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Job controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class JobsController extends ResourceController
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
    protected $resource = 'job';


    /**
     * @var array
     */
    protected $editActionFormData = [

    ];

    /**
     * JobsController constructor.
     * @param Gate $gate
     * @param JobRepository $jobRepository
     */
    public function __construct(
        Gate $gate,
        JobRepository $jobRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $jobRepository;

        $this->middleware('dashboard');
        $this->shareSidebar();
    }
}
