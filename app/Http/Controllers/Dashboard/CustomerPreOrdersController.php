<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerPreOrderRepository;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerPreOrder controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerPreOrdersController extends ResourceController
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
    protected $resource = 'customer_pre_order';

    /**
     * @var array
     */
    protected $with = [
        'customerUser',
        'customerOrder',
        'customer',
    ];

	/**
	 * @var CustomerUserRepository
	 */
	protected $customerUsers;

	/**
	 * @var CustomerOrderRepository
	 */
	protected $customerOrders;

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
		'customerUsers' => 'name',
		'customerOrders' => 'number',
		'customers' => 'name',
	];

    /**
     * @var array
     */
    protected $popupActions = [
        'create' => 'fullscreen',
        'edit' => 'fullscreen'
    ];

    /**
     * CustomerPreOrdersController constructor.
     * @param Gate $gate
     * @param CustomerPreOrderRepository $customerPreOrderRepository
     * @param CustomerUserRepository $customerUserRepository
     * @param CustomerOrderRepository $customerOrderRepository
     * @param CustomerRepository $customerRepository
     * @param ProductRepository $productRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerPreOrderRepository $customerPreOrderRepository,
		CustomerUserRepository $customerUserRepository,
		CustomerOrderRepository $customerOrderRepository,
		CustomerRepository $customerRepository,
		ProductRepository $productRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerPreOrderRepository;
		$this->customerUsers = $customerUserRepository;
		$this->customerOrders = $customerOrderRepository;
		$this->customers = $customerRepository;
		$this->products = $productRepository;

		$this->editActionFormData = array_merge($this->editActionFormData, [
            'products' => [
                'lists' => 'name',
                'query' => $this->getProductsQueryScope()
            ]
        ]);

	    $this->middleware('auth:dashboard');
        $this->shareSidebar();
	}

    /**
     * Returns a part of products query.
     *
     * @return \Closure
     */
    protected function getProductsQueryScope()
    {
        return function ($customerPreOrder) {
            return function ($query) use ($customerPreOrder) {
                if (is_object($customerPreOrder)) {
                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    return $query
                        ->distinct()
                        ->select('products.*')
                        ->join(
                            'customer_pricing_policies',
                            'customer_pricing_policies.product_group_id',
                            '=',
                            'products.product_group_id'
                        )->where('customer_pricing_policies.customer_id', '=', $customerPreOrder->customer_id);
                }

                return $query;
            };
        };
    }
}
