<?php

namespace App\Console\Commands;

use App\Job;
use App\Repositories\Contracts\JobRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Job resource creator.
 *
 * @package App\Console\Commands
 */
class JobCreator extends ResourceCreator
{
    protected $name = 'resource:create:job';



	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    Job $job,
		JobRepository $jobRepository
	)
	{
	    $this->resource = $job;
		$this->repository = $jobRepository;

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
		return 'job';
	}

	/**
	 * @param Job $job
	 * @return array
	 */
	public function getEventAttributes($job)
	{
		return $job->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}