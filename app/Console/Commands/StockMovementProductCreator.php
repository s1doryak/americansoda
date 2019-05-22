<?php

namespace App\Console\Commands;

use App\StockMovementProduct;
use App\Repositories\Contracts\StockMovementProductRepository;
use App\Repositories\Contracts\StockMovementRepository;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * StockMovementProduct resource creator.
 *
 * @package App\Console\Commands
 */
class StockMovementProductCreator extends ResourceCreator
{
    protected $name = 'resource:create:stock_movement_product';

	/**
	 * @var StockMovementRepository
	 */
	protected $stockMovements;
	
	/**
	 * @var ProductRepository
	 */
	protected $products;
	

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'stockMovements' => 'name',
		'products' => 'name',
	];

	public function __construct(
	    StockMovementProduct $stockMovementProduct,
		StockMovementProductRepository $stockMovementProductRepository,
		StockMovementRepository $stockMovementRepository,
		ProductRepository $productRepository
	)
	{
	    $this->resource = $stockMovementProduct;
		$this->repository = $stockMovementProductRepository;
		$this->stockMovements = $stockMovementRepository;
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
		return 'stock_movement_product';
	}

	/**
	 * @param StockMovementProduct $stock_movement_product
	 * @return array
	 */
	public function getEventAttributes($stock_movement_product)
	{
		return $stock_movement_product->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}