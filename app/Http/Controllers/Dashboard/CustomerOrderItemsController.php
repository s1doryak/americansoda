<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerOrderItem controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerOrderItemsController extends ResourceController
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
    protected $resource = 'customer_order_item';

	/**
	 * @var ProductRepository
	 */
	protected $products;
	
	/**
	 * @var CustomerRepository
	 */
	protected $customers;
	
	/**
	 * @var CustomerOrderRepository
	 */
	protected $customerOrders;
	
	/**
	 * @var CustomerShipmentRepository
	 */
	protected $customerShipments;
	

    /**
     * @var array
     */
	protected $editActionFormData = [
		'products' => 'name',
		'customers' => 'name',
		'customerOrders' => 'name',
		'customerShipments' => 'name',
	];

    /**
     * CustomerOrderItemsController constructor.
     * @param Gate $gate
	 * @param CustomerOrderItemRepository $customerOrderItemRepository
	 * @param ProductRepository $productRepository
	 * @param CustomerRepository $customerRepository
	 * @param CustomerOrderRepository $customerOrderRepository
	 * @param CustomerShipmentRepository $customerShipmentRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerOrderItemRepository $customerOrderItemRepository,
		ProductRepository $productRepository,
		CustomerRepository $customerRepository,
		CustomerOrderRepository $customerOrderRepository,
		CustomerShipmentRepository $customerShipmentRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerOrderItemRepository;
		$this->products = $productRepository;
		$this->customers = $customerRepository;
		$this->customerOrders = $customerOrderRepository;
		$this->customerShipments = $customerShipmentRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
