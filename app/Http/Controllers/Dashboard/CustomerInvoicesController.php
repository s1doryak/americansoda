<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Customer;
use App\Jobs\MaventaConfirmInvoice;
use App\Jobs\MaventaCreateInvoice;
use App\Repositories\Contracts\CompanyRepository;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use PDF;
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
     * @var array
     */
    protected $with = [
        'customer',
        'customerShipment',
        'companyBankAccounts',
    ];

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * @var CustomerShipmentRepository
     */
    protected $customerShipments;

    /**
     * @var CompanyRepository
     */
    protected $companies;

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
     * @param CompanyRepository $companyRepository
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
        CompanyRepository $companyRepository,
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
        $this->companies = $companyRepository;
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

    /**
     * @param Request $request
     * @return array
     */
    protected function getDocumentData(Request $request)
    {
        /** @var Company $company */
        $company = $this->companies->with('region')->first();

        /** @var CustomerInvoice $invoice */
        $invoice = $this->repository->with([
            'customer',
            'customer.billingRegion',
            'customer.shippingRegion',
            'customer.user',
            'customer.stock',
            'customer.stock.region'
        ])->find(
            $this->getResourceId()
        );

        /** @var Customer $customer */
        $customer = $invoice->customer;

        $invoiceItems = $invoice->customerInvoiceItems;

        $totalVats = get_total_vats($invoiceItems);
        $totalDeposits = get_total_deposits($invoiceItems);
        $totalPrice = $invoiceItems->sum('sum');
        $totalVatPrice = $invoiceItems->sum('sum_tax');

        return compact(
            'company',
            'customer',
            'invoice',
            'invoiceItems',
            'totalVats',
            'totalDeposits',
            'totalPrice',
            'totalVatPrice'
        );
    }

    /**
     * @return mixed
     */
    public function invoice(Request $request)
    {
        /** @var CustomerInvoice $customerInvoice */
        $customerInvoice = $this->repository->find(
            $this->getResourceId()
        );

        $filename = preg_replace('/\s+/mui', '_', sprintf('%s_%s_%s_%s.pdf', $customerInvoice->id, $customerInvoice->invoice_nr, $customerInvoice->customer->name, mb_strtoupper('Laskufaktura')));

        if ($request->has('inline')) {
            return view('dashboard::documents.invoice', $this->getDocumentData($request));
        }

        return PDF::loadView('dashboard::documents.invoice', $this->getDocumentData($request))->inline($filename);
    }

    /**
     * @return mixed
     */
    public function maventaPaid()
    {
        /** @var CustomerInvoice|null $customerInvoice */
        $result = MaventaConfirmInvoice::dispatchNow(
            $this->getResourceId()
        );

        return $result ? $result : 'ERROR';
    }

    /**
     * @return mixed
     */
    public function maventaSentAt()
    {
        /** @var CustomerInvoice|null $customerInvoice */
        $result = MaventaCreateInvoice::dispatchNow(
            $this->getResourceId()
        );

        return $result ? $result->status : 'ERROR';
    }

}
