<?php

namespace App\Console\Commands\Resources;

use App\CustomerInvoiceAction;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerInvoiceAction resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerInvoiceActionCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_invoice_action';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_invoice_action';

    /**
     * @var string
     */
    protected $action = 'store';

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
	    $this->model = $customerInvoiceAction;
		$this->repository = $customerInvoiceActionRepository;
		$this->customerInvoices = $customerInvoiceRepository;

        parent::__construct();
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
