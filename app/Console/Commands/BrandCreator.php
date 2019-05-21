<?php

namespace App\Console\Commands;

use App\Brand;
use App\Repositories\Contracts\BrandRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Brand resource creator.
 *
 * @package App\Console\Commands
 */
class BrandCreator extends ResourceCreator
{
    protected $name = 'resource:create:brand';



	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    Brand $brand,
		BrandRepository $brandRepository
	)
	{
	    $this->resource = $brand;
		$this->repository = $brandRepository;

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
		return 'brand';
	}

	/**
	 * @param Brand $brand
	 * @return array
	 */
	public function getEventAttributes($brand)
	{
		return $brand->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}