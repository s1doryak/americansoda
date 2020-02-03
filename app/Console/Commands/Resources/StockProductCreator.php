<?php

namespace App\Console\Commands\Resources;

use App\StockProduct;
use App\Repositories\Contracts\StockProductRepository;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * StockProduct resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class StockProductCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:stock_product';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'stock_product';

    /**
     * @var string
     */
    protected $action = 'store';

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
        $this->model = $stockProduct;
        $this->repository = $stockProductRepository;
        $this->stocks = $stockRepository;
        $this->products = $productRepository;
        $this->customerOrderItems = $customerOrderItemRepository;

        parent::__construct();
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
