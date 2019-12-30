<?php

namespace App\Console\Commands\Resources;

use App\ProductGroup;
use App\Repositories\Contracts\ProductGroupRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;
use App\Repositories\Contracts\ProductTypeRepository;

/**
 * ProductGroup resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class ProductGroupCreator extends ResourceCreator
{

	/**
	 * @var ProductTypeRepository
	 */
	protected $productTypes;
    protected $name = 'resource:create:product_group';



	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'productTypes' => 'name',
	];

	public function __construct(
	    ProductGroup $productGroup,
		ProductGroupRepository $productGroupRepository,
		ProductTypeRepository $productTypeRepository
	)
	{
	    $this->productTypes = $productTypeRepository;
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
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
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
