<?php

namespace App\Console\Commands\Resources;

use App\ProductType;
use App\Repositories\Contracts\ProductTypeRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * ProductType resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class ProductTypeCreator extends ResourceCreator
{
    protected $name = 'resource:create:product_type';



	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    ProductType $productType,
		ProductTypeRepository $productTypeRepository
	)
	{
	    $this->resource = $productType;
		$this->repository = $productTypeRepository;

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
		return 'product_type';
	}

	/**
	 * @param ProductType $productType
	 * @return array
	 */
	public function getEventAttributes($productType)
	{
		return $productType->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}