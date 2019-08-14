<?php

namespace App\Console\Commands\Resources;

use App\ProductGroup;
use App\Repositories\Contracts\ProductGroupRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * ProductGroup resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class ProductGroupCreator extends ResourceCreator
{
    protected $name = 'resource:create:product_group';



	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    ProductGroup $productGroup,
		ProductGroupRepository $productGroupRepository
	)
	{
	    $this->resource = $productGroup;
		$this->repository = $productGroupRepository;

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
		return 'product_group';
	}

	/**
	 * @param ProductGroup $product_group
	 * @return array
	 */
	public function getEventAttributes($product_group)
	{
		return $product_group->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
