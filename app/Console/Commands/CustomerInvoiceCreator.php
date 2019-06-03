<?php

namespace App\Console\Commands;

use App\CustomerInvoice;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\CompanyBankAccountRepository;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerInvoice resource creator.
 *
 * @package App\Console\Commands
 */
class CustomerInvoiceCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_invoice';

	
	/**
	 * @var CustomerRepository
	 */
	protected $customers;
	
	/**
	 * @var CustomerShipmentRepository
	 */
	protected $shipments;
	
	/**
	 * @var CompanyBankAccountRepository
	 */
	protected $accounts;
	
	/**
	 * @var CustomerInvoiceItemRepository
	 */
	protected $items;
	
	/**
	 * @var CustomerInvoiceActionRepository
	 */
	protected $actions;
	
	/**
	 * @var CustomerInvoiceAttachmentRepository
	 */
	protected $attachments;
	
	/**
	 * @var CustomerOrderItemRepository
	 */
	protected $orderItems;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'customers' => 'name',
		'shipments' => 'name',
		'accounts' => 'name',
		'items' => 'name',
		'actions' => 'name',
		'attachments' => 'name',
		'orderItems' => 'name',
	];

	public function __construct(
	    CustomerInvoice $customerInvoice,
		CustomerInvoiceRepository $customerInvoiceRepository,
		CustomerRepository $customerRepository,
		CustomerShipmentRepository $customerShipmentRepository,
		CompanyBankAccountRepository $companyBankAccountRepository,
		CustomerInvoiceItemRepository $customerInvoiceItemRepository,
		CustomerInvoiceActionRepository $customerInvoiceActionRepository,
		CustomerInvoiceAttachmentRepository $customerInvoiceAttachmentRepository,
		CustomerOrderItemRepository $customerOrderItemRepository
	)
	{
	    $this->resource = $customerInvoice;
		$this->repository = $customerInvoiceRepository;
		$this->customers = $customerRepository;
		$this->shipments = $customerShipmentRepository;
		$this->accounts = $companyBankAccountRepository;
		$this->items = $customerInvoiceItemRepository;
		$this->actions = $customerInvoiceActionRepository;
		$this->attachments = $customerInvoiceAttachmentRepository;
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
		return 'customer_invoice';
	}

	/**
	 * @param CustomerInvoice $customer_invoice
	 * @return array
	 */
	public function getEventAttributes($customer_invoice)
	{
		return $customer_invoice->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}