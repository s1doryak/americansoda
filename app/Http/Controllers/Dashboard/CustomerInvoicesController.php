<?php

namespace App\Http\Controllers\Dashboard;

use App\CustomerInvoice;
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
        'companyBankAccounts' => [
            'lists' => 'account',
            'extra' => 'content'
        ],
        'customers' => [
            'lists' => 'name',
            'extra' => 'content'
        ],
        'customerShipments' => [
            'lists' => 'number',
            'extra' => 'content'
        ],
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

        $this->createActionFormData = [
            'companyBankAccounts' => [
                'lists' => 'account',
                'extra' => 'content'
            ],
            'customers' => [
                'lists' => 'name',
                'extra' => 'content'
            ],
            //'customerInvoiceItems' => 'item_code',
            //'customerInvoiceActions' => 'action',
            //'customerInvoiceAttachments' => 'filename',
            //'customerOrders' => 'number',
            //'customerOrderItems' => 'product_name',
            'products' => 'name',
        ];

        $this->editActionFormData = [
            'companyBankAccounts' => [
                'lists' => 'account',
                'extra' => 'content'
            ],
            'customers' => [
                'lists' => 'name',
                'extra' => 'content',
                'query' => function (CustomerInvoice $customerInvoice) {
                    return function ($query) use ($customerInvoice) {
                        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                        return $query->where('id', '=', $customerInvoice->customer_id);
                    };
                }
            ],
            'customerShipments' => [
                'lists' => 'number',
                'extra' => 'content',
                'query' => function (CustomerInvoice $customerInvoice) {
                    return function ($query) use ($customerInvoice) {
                        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                        return $query->where('id', '=', $customerInvoice->customer_shipment_id);
                    };
                }
            ],
            //'customerInvoiceItems' => 'item_code',
            //'customerInvoiceActions' => 'action',
            //'customerInvoiceAttachments' => 'filename',
            //'customerOrders' => 'number',
            //'customerOrderItems' => 'product_name',
            'products' => 'name',
        ];

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }

    /**
     * Build redirect URL to point user after successful store.
     *
     * @param $action
     * @param CustomerInvoice|null $customerInvoice
     * @return string
     */
    protected function getRedirectUrl($action, $customerInvoice = null)
    {
        if ($customerInvoice && $customerInvoice->getKey()) {
            return route(sprintf('%s.%s.edit', $this->getPrefix(), $this->getResource()), $customerInvoice->getKey());
        }

        return route(sprintf('%s.%s.index', $this->getPrefix(), $this->getResource()));
    }

}
