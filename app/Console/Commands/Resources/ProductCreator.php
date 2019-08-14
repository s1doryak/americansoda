<?php

namespace App\Console\Commands\Resources;

use App\Product;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\BrandRepository;
use App\Repositories\Contracts\PackageTypeRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Product resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class ProductCreator extends ResourceCreator
{
    protected $name = 'resource:create:product';

	/**
	 * @var BrandRepository
	 */
	protected $brands;

	/**
	 * @var PackageTypeRepository
	 */
	protected $packageTypes;

	/**
	 * @var ProductGroupRepository
	 */
	protected $productGroups;


	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'brands' => 'name',
		'packageTypes' => 'name',
		'productGroups' => 'name',
	];

	public function __construct(
	    Product $product,
		ProductRepository $productRepository,
		BrandRepository $brandRepository,
		PackageTypeRepository $packageTypeRepository,
		ProductGroupRepository $productGroupRepository
	)
	{
	    $this->resource = $product;
		$this->repository = $productRepository;
		$this->brands = $brandRepository;
		$this->packageTypes = $packageTypeRepository;
		$this->productGroups = $productGroupRepository;

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
		return 'product';
	}

	/**
	 * @param Product $product
	 * @return array
	 */
	public function getEventAttributes($product)
	{
		return $product->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
