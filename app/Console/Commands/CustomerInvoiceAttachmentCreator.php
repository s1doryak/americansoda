<?php

namespace App\Console\Commands;

use App\CustomerInvoiceAttachment;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerInvoiceAttachment resource creator.
 *
 * @package App\Console\Commands
 */
class CustomerInvoiceAttachmentCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_invoice_attachment';

	
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
	    CustomerInvoiceAttachment $customerInvoiceAttachment,
		CustomerInvoiceAttachmentRepository $customerInvoiceAttachmentRepository,
		CustomerInvoiceRepository $customerInvoiceRepository
	)
	{
	    $this->resource = $customerInvoiceAttachment;
		$this->repository = $customerInvoiceAttachmentRepository;
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
		return 'customer_invoice_attachment';
	}

	/**
	 * @param CustomerInvoiceAttachment $customer_invoice_attachment
	 * @return array
	 */
	public function getEventAttributes($customer_invoice_attachment)
	{
		return $customer_invoice_attachment->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}