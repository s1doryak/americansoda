<?php

namespace App\Console\Commands\Resources;

use App\Brand;
use App\Repositories\Contracts\BrandRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Brand resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class BrandCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:brand';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'brand';

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
	    Brand $brand,
		BrandRepository $brandRepository
	)
	{
	    $this->model = $brand;
		$this->repository = $brandRepository;

        parent::__construct();
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
