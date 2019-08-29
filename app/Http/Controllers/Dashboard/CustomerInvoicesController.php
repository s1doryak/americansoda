<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\CompanyBankAccountRepository;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerInvoice controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerInvoicesController extends ResourceController
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
    protected $resource = 'customer_invoice';

	/**
	 * @var CustomerRepository
	 */
	protected $customers;

	/**
	 * @var CustomerShipmentRepository
	 */
	protected $customerShipments;

	/**
	 * @var CompanyBankAccountRepository
	 */
	protected $companyBankAccounts;

	/**
	 * @var CustomerInvoiceItemRepository
	 */
	protected $customerInvoiceItems;

	/**
	 * @var CustomerInvoiceActionRepository
	 */
	protected $customerInvoiceActions;

	/**
	 * @var CustomerInvoiceAttachmentRepository
	 */
	protected $customerInvoiceAttachments;

	/**
	 * @var CustomerOrderItemRepository
	 */
	protected $customerOrderItems;

    /**
     * @var array
     */
	protected $editActionFormData = [
        'companyBankAccounts' => 'iban',
		'customers' => 'name',
		'customerShipments' => 'number',
		'customerInvoiceItems' => 'item_code',
		'customerInvoiceActions' => 'action',
		'customerInvoiceAttachments' => 'filename',
		'customerOrderItems' => 'product_name',
	];

    /**
     * CustomerInvoicesController constructor.
     * @param Gate $gate
	 * @param CustomerInvoiceRepository $customerInvoiceRepository
	 * @param CustomerRepository $customerRepository
	 * @param CustomerShipmentRepository $customerShipmentRepository
	 * @param CompanyBankAccountRepository $companyBankAccountRepository
	 * @param CustomerInvoiceItemRepository $customerInvoiceItemRepository
	 * @param CustomerInvoiceActionRepository $customerInvoiceActionRepository
	 * @param CustomerInvoiceAttachmentRepository $customerInvoiceAttachmentRepository
	 * @param CustomerOrderItemRepository $customerOrderItemRepository
     */
	public function __construct(
	    Gate $gate,
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
	    $this->gate = $gate;
		$this->repository = $customerInvoiceRepository;
		$this->customers = $customerRepository;
		$this->customerShipments = $customerShipmentRepository;
		$this->companyBankAccounts = $companyBankAccountRepository;
		$this->customerInvoiceItems = $customerInvoiceItemRepository;
		$this->customerInvoiceActions = $customerInvoiceActionRepository;
		$this->customerInvoiceAttachments = $customerInvoiceAttachmentRepository;
		$this->customerOrderItems = $customerOrderItemRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
