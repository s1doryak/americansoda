<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\App\Traits\AppSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\JobRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Job controller.
 *
 * @package App\Http\Controllers\App
 */
class JobsController extends ResourceController
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

        $this->middleware('app'); //$this->middleware('auth:app');
        $this->shareSidebar();
    }
}
