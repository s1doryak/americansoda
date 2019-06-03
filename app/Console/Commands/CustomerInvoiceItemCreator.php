<?php

namespace App\Console\Commands;

use App\CustomerInvoiceItem;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerInvoiceItem resource creator.
 *
 * @package App\Console\Commands
 */
class CustomerInvoiceItemCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_invoice_item';

	
	/**
	 * @var CustomerInvoiceRepository
	 */
	protected $invoices;
	
	/**
	 * @var CustomerOrderItemRepository
	 */
	protected $orderItems;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'invoices' => 'name',
		'orderItems' => 'name',
	];

	public function __construct(
	    CustomerInvoiceItem $customerInvoiceItem,
		CustomerInvoiceItemRepository $customerInvoiceItemRepository,
		CustomerInvoiceRepository $customerInvoiceRepository,
		CustomerOrderItemRepository $customerOrderItemRepository
	)
	{
	    $this->resource = $customerInvoiceItem;
		$this->repository = $customerInvoiceItemRepository;
		$this->invoices = $customerInvoiceRepository;
		$this->orderItems = $customerOrderItemRepository;

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
		return 'customer_invoice_item';
	}

	/**
	 * @param CustomerInvoiceItem $customer_invoice_item
	 * @return array
	 */
	public function getEventAttributes($customer_invoice_item)
	{
		return $customer_invoice_item->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}