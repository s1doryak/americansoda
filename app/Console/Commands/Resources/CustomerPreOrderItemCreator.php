<?php

namespace App\Console\Commands\Resources;

use App\CustomerPreOrderItem;
use App\Repositories\Contracts\CustomerPreOrderItemRepository;
use App\Repositories\Contracts\CustomerPreOrderRepository;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerPreOrderItem resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerPreOrderItemCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_pre_order_item';


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
	protected $findOrCreateData = [
		'customerPreOrders' => 'number',
		'customerUsers' => 'name',
		'customers' => 'name',
		'products' => 'name',
	];

	public function __construct(
	    CustomerPreOrderItem $customerPreOrderItem,
		CustomerPreOrderItemRepository $customerPreOrderItemRepository,
		CustomerPreOrderRepository $customerPreOrderRepository,
		CustomerUserRepository $customerUserRepository,
		CustomerRepository $customerRepository,
		ProductRepository $productRepository
	)
	{
	    $this->resource = $customerPreOrderItem;
		$this->repository = $customerPreOrderItemRepository;
		$this->customerPreOrders = $customerPreOrderRepository;
		$this->customerUsers = $customerUserRepository;
		$this->customers = $customerRepository;
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
		return 'customer_pre_order_item';
	}

    /**
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
    }

	/**
	 * @param CustomerPreOrderItem $customerPreOrderItem
	 * @return array
	 */
	public function getEventAttributes($customerPreOrderItem)
	{
		return $customerPreOrderItem->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
