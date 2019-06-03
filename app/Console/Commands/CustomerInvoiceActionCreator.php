<?php

namespace App\Console\Commands;

use App\CustomerInvoiceAction;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerInvoiceAction resource creator.
 *
 * @package App\Console\Commands
 */
class CustomerInvoiceActionCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_invoice_action';

	
	/**
	 * @var CustomerInvoiceRepository
	 */
	protected $customerInvoices;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'customerInvoices' => 'name',
	];

	public function __construct(
	    CustomerInvoiceAction $customerInvoiceAction,
		CustomerInvoiceActionRepository $customerInvoiceActionRepository,
		CustomerInvoiceRepository $customerInvoiceRepository
	)
	{
	    $this->resource = $customerInvoiceAction;
		$this->repository = $customerInvoiceActionRepository;
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
		return 'customer_invoice_action';
	}

	/**
	 * @param CustomerInvoiceAction $customer_invoice_action
	 * @return array
	 */
	public function getEventAttributes($customer_invoice_action)
	{
		return $customer_invoice_action->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}