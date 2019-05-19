<?php

namespace App\Console\Commands;

use App\FailedJob;
use App\Repositories\Contracts\FailedJobRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * FailedJob resource creator.
 *
 * @package App\Console\Commands
 */
class FailedJobCreator extends ResourceCreator
{
    protected $name = 'resource:create:failed_job';



	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    FailedJob $failedJob,
		FailedJobRepository $failedJobRepository
	)
	{
	    $this->resource = $failedJob;
		$this->repository = $failedJobRepository;

        parent::__construct();
	}

	/**
	 * @return string
	 */
	public function getEventNamespace()
	{
		return 'cli';
	}

	/**
	 * @return string
	 */
	public function getEventResource()
	{
		return 'failed_job';
	}

	/**
	 * @param FailedJob $failed_job
	 * @return array
	 */
	public function getEventAttributes($failed_job)
	{
		return $failed_job->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}