<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\FailedJobRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * FailedJob controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class FailedJobsController extends ResourceController
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
    protected $resource = 'failed_job';


    /**
     * @var array
     */
    protected $editActionFormData = [

    ];

    /**
     * FailedJobsController constructor.
     * @param Gate $gate
     * @param FailedJobRepository $failedJobRepository
     */
    public function __construct(
        Gate $gate,
        FailedJobRepository $failedJobRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $failedJobRepository;

        $this->middleware('dashboard');
        $this->shareSidebar();
    }
}
