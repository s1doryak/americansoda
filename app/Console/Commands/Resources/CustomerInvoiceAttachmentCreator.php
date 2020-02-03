<?php

namespace App\Console\Commands\Resources;

use App\CustomerInvoiceAttachment;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerInvoiceAttachment resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerInvoiceAttachmentCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_invoice_attachment';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_invoice_attachment';

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
	    CustomerInvoiceAttachment $customerInvoiceAttachment,
		CustomerInvoiceAttachmentRepository $customerInvoiceAttachmentRepository,
		CustomerInvoiceRepository $customerInvoiceRepository
	)
	{
	    $this->model = $customerInvoiceAttachment;
		$this->repository = $customerInvoiceAttachmentRepository;
		$this->customerInvoices = $customerInvoiceRepository;

        parent::__construct();
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
