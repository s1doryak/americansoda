<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\CompanyBankAccountRepository;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Routing\ResourceController;
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
     * @var CustomerOrderRepository
     */
    protected $customerOrders;

    /**
     * @var ProductRepository
     */
    protected $products;

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
        'customerOrders' => 'number',
        'customerOrderItems' => 'product_name',
        'products' => 'name',
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
     * @param CustomerOrderRepository $customerOrderRepository
     * @param ProductRepository $productRepository
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
        CustomerOrderItemRepository $customerOrderItemRepository,
        CustomerOrderRepository $customerOrderRepository,
        ProductRepository $productRepository
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
        $this->customerOrders = $customerOrderRepository;
        $this->products = $productRepository;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }
}
