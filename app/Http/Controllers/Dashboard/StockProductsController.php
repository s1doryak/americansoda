<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\StockProductRepository;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * StockProduct controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class StockProductsController extends ResourceController
{
    use DashboardSidebar;

    /**
     * @var Gate
     */
    protected $gate;

    /**
     * @var string
     */
    protected $prefix = 'dashboard';

    /**
     * @var string
     */
    protected $resource = 'stock_product';

    /**
     * @var array
     */
    protected $with = [
        'stock',
        'product',
        'product.productGroup',
        'customerOrderItem',
    ];

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
    protected $editActionFormData = [
        'stocks' => 'name',
        'products' => 'name',
        'customerOrderItems' => 'name',
    ];

    /**
     * StockProductsController constructor.
     * @param Gate $gate
     * @param StockProductRepository $stockProductRepository
     * @param StockRepository $stockRepository
     * @param ProductRepository $productRepository
     * @param CustomerOrderItemRepository $customerOrderItemRepository
     */
    public function __construct(
        Gate $gate,
        StockProductRepository $stockProductRepository,
        StockRepository $stockRepository,
        ProductRepository $productRepository,
        CustomerOrderItemRepository $customerOrderItemRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $stockProductRepository;
        $this->stocks = $stockRepository;
        $this->products = $productRepository;
        $this->customerOrderItems = $customerOrderItemRepository;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }
}
