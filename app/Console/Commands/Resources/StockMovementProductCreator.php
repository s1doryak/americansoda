<?php

namespace App\Console\Commands\Resources;

use App\StockMovementProduct;
use App\Repositories\Contracts\StockMovementProductRepository;
use App\Repositories\Contracts\StockMovementRepository;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * StockMovementProduct resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class StockMovementProductCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:stock_movement_product';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'stock_movement_product';

    /**
     * @var string
     */
    protected $action = 'store';

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
        $this->model = $stockMovementProduct;
        $this->repository = $stockMovementProductRepository;
        $this->stockMovements = $stockMovementRepository;
        $this->products = $productRepository;

        parent::__construct();
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
