<?php

namespace App\Console\Commands\Resources;

use App\CustomerOrderItem;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerOrderItem resource creator.
 *
 * @package App\Console\Commands\Resources
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
	 * @var CustomerInvoiceRepository
	 */
	protected $customerInvoices;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'products' => 'name',
		'customers' => 'name',
		'customerOrders' => 'name',
		'customerShipments' => 'name',
		'customerInvoices' => 'name',
	];

	public function __construct(
		CustomerOrderItem $customerOrderItem,
		CustomerOrderItemRepository $customerOrderItemRepository,
		ProductRepository $productRepository,
		CustomerRepository $customerRepository,
		CustomerOrderRepository $customerOrderRepository,
		CustomerShipmentRepository $customerShipmentRepository,
		CustomerInvoiceRepository $customerInvoiceRepository
	)
	{
		$this->resource = $customerOrderItem;
		$this->repository = $customerOrderItemRepository;
		$this->products = $productRepository;
		$this->customers = $customerRepository;
		$this->customerOrders = $customerOrderRepository;
		$this->customerShipments = $customerShipmentRepository;
		$this->customerInvoices = $customerInvoiceRepository;

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
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
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
