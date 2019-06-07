<?php

namespace App\Http\Controllers\Dashboard;

use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerPreOrderItemRepository;
use App\Repositories\Contracts\CustomerPreOrderRepository;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\ProductRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerPreOrderItem controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerPreOrderItemsController extends ResourceController
{
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
    protected $resource = 'customer_pre_order_item';

	
	/**
	 * @var CustomerPreOrderRepository
	 */
	protected $customerPreOrders;
	
	/**
	 * @var CustomerUserRepository
	 */
	protected $customerUsers;
	
	/**
	 * @var CustomerRepository
	 */
	protected $customers;
	
	/**
	 * @var ProductRepository
	 */
	protected $products;

    /**
     * @var array
     */
	protected $editActionFormData = [
		'customerPreOrders' => 'number',
		'customerUsers' => 'name',
		'customers' => 'name',
		'products' => 'name',
	];

    /**
     * CustomerPreOrderItemsController constructor.
     * @param Gate $gate
	 * @param CustomerPreOrderItemRepository $customerPreOrderItemRepository
	 * @param CustomerPreOrderRepository $customerPreOrderRepository
	 * @param CustomerUserRepository $customerUserRepository
	 * @param CustomerRepository $customerRepository
	 * @param ProductRepository $productRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerPreOrderItemRepository $customerPreOrderItemRepository,
		CustomerPreOrderRepository $customerPreOrderRepository,
		CustomerUserRepository $customerUserRepository,
		CustomerRepository $customerRepository,
		ProductRepository $productRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerPreOrderItemRepository;
		$this->customerPreOrders = $customerPreOrderRepository;
		$this->customerUsers = $customerUserRepository;
		$this->customers = $customerRepository;
		$this->products = $productRepository;

	    $this->middleware('auth:dashboard');
	}
}
