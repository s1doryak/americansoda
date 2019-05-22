<?php

namespace App\Console\Commands;

use App\CustomerOrderItem;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerOrderItem resource creator.
 *
 * @package App\Console\Commands
 */
class CustomerOrderItemCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_order_item';

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
	protected $findOrCreateData = [
		'products' => 'name',
		'customers' => 'name',
		'customerOrders' => 'name',
		'customerShipments' => 'name',
	];

	public function __construct(
	    CustomerOrderItem $customerOrderItem,
		CustomerOrderItemRepository $customerOrderItemRepository,
		ProductRepository $productRepository,
		CustomerRepository $customerRepository,
		CustomerOrderRepository $customerOrderRepository,
		CustomerShipmentRepository $customerShipmentRepository
	)
	{
	    $this->resource = $customerOrderItem;
		$this->repository = $customerOrderItemRepository;
		$this->products = $productRepository;
		$this->customers = $customerRepository;
		$this->customerOrders = $customerOrderRepository;
		$this->customerShipments = $customerShipmentRepository;

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
		return 'customer_order_item';
	}

	/**
	 * @param CustomerOrderItem $customer_order_item
	 * @return array
	 */
	public function getEventAttributes($customer_order_item)
	{
		return $customer_order_item->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}