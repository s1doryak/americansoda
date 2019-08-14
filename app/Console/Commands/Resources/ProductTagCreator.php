<?php

namespace App\Console\Commands\Resources;

use App\ProductTag;
use App\Repositories\Contracts\ProductTagRepository;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * ProductTag resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class ProductTagCreator extends ResourceCreator
{
    protected $name = 'resource:create:product_tag';

	/**
	 * @var ProductRepository
	 */
	protected $products;


	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'products' => 'name',
	];

	public function __construct(
	    ProductTag $productTag,
		ProductTagRepository $productTagRepository,
		ProductRepository $productRepository
	)
	{
	    $this->resource = $productTag;
		$this->repository = $productTagRepository;
		$this->products = $productRepository;

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
		return 'product_tag';
	}

	/**
	 * @param ProductTag $product_tag
	 * @return array
	 */
	public function getEventAttributes($product_tag)
	{
		return $product_tag->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
