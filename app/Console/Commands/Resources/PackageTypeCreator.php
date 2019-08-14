<?php

namespace App\Console\Commands\Resources;

use App\PackageType;
use App\Repositories\Contracts\PackageTypeRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * PackageType resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class PackageTypeCreator extends ResourceCreator
{
    protected $name = 'resource:create:package_type';



	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    PackageType $packageType,
		PackageTypeRepository $packageTypeRepository
	)
	{
	    $this->resource = $packageType;
		$this->repository = $packageTypeRepository;

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
		return 'package_type';
	}

	/**
	 * @param PackageType $package_type
	 * @return array
	 */
	public function getEventAttributes($package_type)
	{
		return $package_type->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
