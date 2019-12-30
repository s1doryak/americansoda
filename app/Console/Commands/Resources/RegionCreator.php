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
    protected $name = 'resource:create:region';



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
	    $this->resource = $region;
		$this->repository = $regionRepository;

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
		return 'region';
	}

    /**
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
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
