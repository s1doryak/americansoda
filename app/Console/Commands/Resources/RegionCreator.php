<?php

namespace App\Console\Commands\Resources;

use App\Region;
use App\Repositories\Contracts\RegionRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Region resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class RegionCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:region';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'region';

    /**
     * @var string
     */
    protected $action = 'store';

	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    Region $region,
		RegionRepository $regionRepository
	)
	{
	    $this->model = $region;
		$this->repository = $regionRepository;

        parent::__construct();
	}

	/**
	 * @param Region $region
	 * @return array
	 */
	public function getEventAttributes($region)
	{
		return $region->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
