<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\StockMovementProductRepository;
use App\Repositories\Contracts\StockMovementRepository;
use App\Repositories\Contracts\ProductRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * StockMovementProduct controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class StockMovementProductsController extends ResourceController
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
    protected $resource = 'stock_movement_product';

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
	protected $editActionFormData = [
		'stockMovements' => 'name',
		'products' => 'name',
	];

    /**
     * StockMovementProductsController constructor.
     * @param Gate $gate
	 * @param StockMovementProductRepository $stockMovementProductRepository
	 * @param StockMovementRepository $stockMovementRepository
	 * @param ProductRepository $productRepository
     */
	public function __construct(
	    Gate $gate,
		StockMovementProductRepository $stockMovementProductRepository,
		StockMovementRepository $stockMovementRepository,
		ProductRepository $productRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $stockMovementProductRepository;
		$this->stockMovements = $stockMovementRepository;
		$this->products = $productRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
