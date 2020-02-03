<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerInvoiceAttachment controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerInvoiceAttachmentsController extends ResourceController
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
    protected $resource = 'customer_invoice_attachment';

    /**
     * @var array
     */
    protected $with = [
        'customerInvoice',
    ];

	/**
	 * @var CustomerInvoiceRepository
	 */
	protected $customerInvoices;

    /**
     * @var array
     */
	protected $editActionFormData = [
		'customerInvoices' => 'name',
	];

    /**
     * CustomerInvoiceAttachmentsController constructor.
     * @param Gate $gate
	 * @param CustomerInvoiceAttachmentRepository $customerInvoiceAttachmentRepository
	 * @param CustomerInvoiceRepository $customerInvoiceRepository
     */
	public function __construct(
	    Gate $gate,
		CustomerInvoiceAttachmentRepository $customerInvoiceAttachmentRepository,
		CustomerInvoiceRepository $customerInvoiceRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $customerInvoiceAttachmentRepository;
		$this->customerInvoices = $customerInvoiceRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
