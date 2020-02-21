<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\ProductRepository;
use App\StockMovement;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\StockMovementRepository;
use App\Repositories\Contracts\StockRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * StockMovement controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class StockMovementsController extends ResourceController
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
    protected $resource = 'stock_movement';

    /**
     * @var array
     */
    protected $with = [
        'product',
        'stock',
        'stockMovement',
        'stockMovement.stock',
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
     * @var array
     */
    protected $editActionFormData = [
        'stocks' => 'name',
        'products' => 'name'
    ];

    /**
     * @var array
     */
    protected $popupActions = [
        'create' => 'large',
        'edit' => 'large'
    ];

    /**
     * StockMovementsController constructor.
     * @param Gate $gate
     * @param StockMovementRepository $stockMovementRepository
     * @param StockRepository $stockRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        Gate $gate,
        StockMovementRepository $stockMovementRepository,
        StockRepository $stockRepository,
        ProductRepository $productRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $stockMovementRepository;
        $this->stocks = $stockRepository;
        $this->products = $productRepository;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }

    /**
     * @param string $action
     * @param StockMovement $stockMovement
     * @return string
     */
    protected function getRedirectUrl($action, $stockMovement = null)
    {
        switch ($action) {
            case 'store':
                return route('dashboard.stock_movement_product.index');
                break;
            default:
                return parent::getRedirectUrl($action, $stockMovement);
        }
    }
}
