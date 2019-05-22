<?php

namespace App\Console\Commands;

use App\StockProduct;
use App\Repositories\Contracts\StockProductRepository;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * StockProduct resource creator.
 *
 * @package App\Console\Commands
 */
class StockProductCreator extends ResourceCreator
{
    protected $name = 'resource:create:stock_product';

	/**
	 * @var StockRepository
	 */
	protected $stocks;
	
	/**
	 * @var ProductRepository
	 */
	protected $products;
	
	/**
	 * @var CustomerOrderItemRepository
	 */
	protected $customerOrderItems;
	

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'stocks' => 'name',
		'products' => 'name',
		'customerOrderItems' => 'name',
	];

	public function __construct(
	    StockProduct $stockProduct,
		StockProductRepository $stockProductRepository,
		StockRepository $stockRepository,
		ProductRepository $productRepository,
		CustomerOrderItemRepository $customerOrderItemRepository
	)
	{
	    $this->resource = $stockProduct;
		$this->repository = $stockProductRepository;
		$this->stocks = $stockRepository;
		$this->products = $productRepository;
		$this->customerOrderItems = $customerOrderItemRepository;

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
		return 'stock_product';
	}

	/**
	 * @param StockProduct $stock_product
	 * @return array
	 */
	public function getEventAttributes($stock_product)
	{
		return $stock_product->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}