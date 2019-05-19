<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\App\Traits\AppSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\FailedJobRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * FailedJob controller.
 *
 * @package App\Http\Controllers\App
 */
class FailedJobsController extends ResourceController
{
    use AppSidebar;

    /**
     * @var Gate
     */
    protected $gate;

    /**
     * @var string
     */
    protected $prefix = 'app';

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

        $this->middleware('app'); //  $this->middleware('auth:app');
        $this->shareSidebar();
    }
}
