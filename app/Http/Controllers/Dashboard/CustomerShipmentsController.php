<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Customer;
use App\CustomerInvoice;
use App\CustomerOrderItem;
use App\LtpTransfer;
use App\Repositories\Contracts\CompanyBankAccountRepository;
use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\LtpTransferItemRepository;
use App\Repositories\Contracts\LtpTransferRepository;
use App\Transformers\Dashboard\CustomerOrderItemTransformer;
use App\Transformers\Dashboard\CustomerShipmentTransformer;
use App\Transformers\Dashboard\LtpTransferTransformer;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Illuminate\Support\Collection;
use PDF;
use App\CustomerShipment;
use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\PackageTypeRepository;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Spatie\ArrayToXml\ArrayToXml;

/**
 * CustomerShipment controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerShipmentsController extends ResourceController
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
    protected $resource = 'customer_shipment';

    /**
     * @var array
     */
    protected $with = [
        'customer',
        'packageType',
        'customerInvoice',
        'customerOrderItems',
        'customerOrderItems.customerOrder',
        'customerOrderItems.product',
    ];

    /**
     * @var PackageTypeRepository
     */
    protected $packageTypes;

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @var CustomerOrderItemRepository
     */
    protected $customerOrderItems;

    /**
     * @var CustomerInvoiceRepository
     */
    protected $customerInvoices;

    /**
     * @var CustomerInvoiceItemRepository
     */
    protected $customerInvoiceItems;

    /**
     * @var CompanyBankAccountRepository
     */
    protected $companyBankAccounts;

    /**
     * @var CompanyRepository
     */
    private $companies;

    /**
     * @var LtpTransferRepository
     */
    protected $ltpTransfers;

    /**
     * @var LtpTransferItemRepository
     */
    protected $ltpTransferItems;

    /**
     * @var array
     */
    protected $editActionFormData = [
        'customers' => [
            'lists' => 'name',
            'prepend_empty' => true
        ],
        'packageTypes' => [
            'lists' => 'name',
            'prepend_empty' => true
        ],
        'products' => 'name',
    ];

    /**
     * @var array
     */
    protected $popupActions = [
        'create' => 'fullscreen',
        'edit' => 'fullscreen',
        'editLtpTransfer' => [
            'resource' => 'ltp_transfer',
            'class' => 'large'
        ]
    ];

    /**
     * CustomerShipmentsController constructor.
     * @param Gate $gate
     * @param CustomerShipmentRepository $customerShipmentRepository
     * @param PackageTypeRepository $packageTypeRepository
     * @param CustomerRepository $customerRepository
     * @param ProductRepository $productRepository
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     * @param CustomerInvoiceItemRepository $customerInvoiceItemRepository
     * @param CustomerOrderItemRepository $customerOrderItemRepository
     * @param CompanyRepository $companyRepository
     * @param CompanyBankAccountRepository $companyBankAccountRepository
     * @param LtpTransferRepository $ltpTransferRepository
     * @param LtpTransferItemRepository $ltpTransferItemRepository
     */
    public function __construct(
        Gate $gate,
        CustomerShipmentRepository $customerShipmentRepository,
        PackageTypeRepository $packageTypeRepository,
        CustomerRepository $customerRepository,
        ProductRepository $productRepository,
        CustomerInvoiceRepository $customerInvoiceRepository,
        CustomerInvoiceItemRepository $customerInvoiceItemRepository,
        CustomerOrderItemRepository $customerOrderItemRepository,
        CompanyRepository $companyRepository,
        CompanyBankAccountRepository $companyBankAccountRepository,
        LtpTransferRepository $ltpTransferRepository,
        LtpTransferItemRepository $ltpTransferItemRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $customerShipmentRepository;
        $this->packageTypes = $packageTypeRepository;
        $this->customers = $customerRepository;
        $this->products = $productRepository;
        $this->customerInvoices = $customerInvoiceRepository;
        $this->customerInvoiceItems = $customerInvoiceItemRepository;
        $this->customerOrderItems = $customerOrderItemRepository;
        $this->companies = $companyRepository;
        $this->companyBankAccounts = $companyBankAccountRepository;
        $this->ltpTransfers = $ltpTransferRepository;
        $this->ltpTransferItems = $ltpTransferItemRepository;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }

    /**
     * Generate a package list.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function packageList(Request $request)
    {
        /** @var CustomerShipment $shipment */
        $shipment = $this->repository->with('customer')->find($this->getResourceId());

        $filename = preg_replace('/\s+/mui', '_', sprintf('%s_%s_%s_%s.pdf', $shipment->id, $shipment->number, $shipment->customer->name, mb_strtoupper('Lähetysluettelo')));

        if ($request->has('inline')) {
            return view('dashboard::documents.package-list', $this->getDocumentData($request));
        }

        return PDF::loadView('dashboard::documents.package-list', $this->getDocumentData($request))->inline($filename);
    }

    /**
     * Generate a waybill.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function waybill(Request $request)
    {
        /** @var CustomerShipment $shipment */
        $shipment = $this->repository->with('customer')->find($this->getResourceId());

        $filename = preg_replace('/\s+/mui', '_', sprintf('%s_%s_%s_%s.pdf', $shipment->id, $shipment->number, $shipment->customer->name, mb_strtoupper('Rahtikirja')));

        if ($request->has('inline')) {
            return view('dashboard::documents.waybill', $this->getDocumentData($request));
        }

        return PDF::loadView('dashboard::documents.waybill', $this->getDocumentData($request))->inline($filename);
    }

    /**
     * Generate a invoice.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function invoice(Request $request)
    {
        /** @var CustomerShipment $shipment */
        $shipment = $this->repository->with(['customer', 'customerInvoice'])->find($this->getResourceId());

        /** @var Customer|null $customer */
        $customer = $shipment->customer;

        /** @var CustomerInvoice|null $customerInvoice */
        $customerInvoice = $shipment->customerInvoice;

        if ($customer && $customer->isNotRequiredForInvoice()) {
            return redirect(
                route(sprintf('%s.customer.edit', $this->getPrefix()), $customer->getKey())
            )->withErrors(
                trans('models/customer.requirements.nr')
            );
        }

        if ($customerInvoice && $customerInvoice instanceof CustomerInvoice) {
            return redirect(
                route("{$this->getPrefix()}.customer_invoice.edit", $customerInvoice->getKey())
            );
        }

        $shipment->load(['customerOrderItems', 'customerOrderItems.product']);

        /** @var Collection $customerInvoiceItems */
        $customerInvoiceItems = CustomerOrderItemTransformer::mapCustomerInvoiceItemsArray($shipment->customerOrderItems);

        /** @var Collection $customerInvoicePalpaItems */
        $customerInvoicePalpaItems = CustomerOrderItemTransformer::mapCustomerInvoicePalpaItemsArray($shipment->customerOrderItems);

        /** @var CustomerInvoice $customerInvoice */
        $customerInvoice = $this->customerInvoices->firstOrCreate([
            'customer_id' => $customer->getKey(),
            'customer_shipment_id' => $shipment->getKey()
        ]);

        $customerInvoice->update([
            'date' => now()->format('Ymd'),
            'invoice_nr' => $this->customerInvoices->getFirstAvailableNumber()
        ]);

        $customerInvoice->companyBankAccounts()->sync(
            $this->companyBankAccounts->getDefault()->pluck('id')
        );

        $attributes = $customerInvoice->toArray();

        $params = [
            'customer' => $customer->getKey(),
            'customerInvoiceItems' => $customerInvoiceItems->concat($customerInvoicePalpaItems)->toArray()
        ];

        event(new ResourceStored($this->getPrefix(), 'customer_invoice', 'invoice', $attributes, $params));

        return redirect(route("{$this->getPrefix()}.customer_invoice.edit", $customerInvoice->getKey()));
    }

    public function toLtpTransfer(Request $request)
    {
        /** @var CustomerShipment $shipment */
        $shipment = $this->repository->with(['customer'])->find($this->getResourceId());
        $transfer = $shipment->ltpTransfer;

        if (!$transfer) {
            $transfer = $this->createLtpTransfer($shipment);
            $attributes = $transfer->toArray();
            event(new ResourceStored($this->getPrefix(), 'ltp_transfer', 'ltp_transfer', $attributes, []));
        }

        return redirect(
            route("{$this->prefix}.ltp_transfer.edit", ['ltp_transfer' => $transfer->getKey()])
        );
    }

    /**
     * @param CustomerShipment $customerShipment
     * @return LtpTransfer
     */
    protected function createLtpTransfer(CustomerShipment $customerShipment)
    {
        /** @var LtpTransfer $ltpTransfer */
        $ltpTransfer = $this->ltpTransfers->create(CustomerShipmentTransformer::toLtpTransfer($customerShipment));

        $ltpTransferItems = [];

        foreach ($customerShipment->customerOrderItems as $index => $customerOrderItem) {
            $transferItem = array_merge(
                CustomerOrderItemTransformer::toLtpTransferItemArray($customerOrderItem),
                [
                    'document_line_number' => $index + 1,
                    'warehouse' => $ltpTransfer->warehouse,
                ]
            );
            $ltpTransferItems[] = $this->ltpTransferItems->create($transferItem);
        }

        $ltpTransfer->items()->saveMany($ltpTransferItems);
        $ltpTransfer->refresh();

        return $ltpTransfer;
    }

    /**
     * Return common document data.
     *
     * @param Request $request
     *
     * @return array
     */
    private function getDocumentData(Request $request, $hideBackOrder = true, $hideCancelled = true)
    {
        /** @var CustomerShipment $shipment */
        $shipment = $this->repository->with([
            'packageType',
            'customer',
            'customer.billingRegion',
            'customer.shippingRegion',
            'customer.stock',
            'customer.stock.region'
        ])->find($this->getResourceId());

        $customerOrderItemIds = $shipment->customerOrderItems->pluck('id')->toArray();

        /** @var Company $company */
        $company = $this->companies->with('region')->first();

        /** @var Customer $customer */
        $customer = $shipment->customer;

        $orderItemsConditions = [
            [
                function ($query) use ($customerOrderItemIds) {
                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    $query->whereIn('id', $customerOrderItemIds);
                },
                null,
                null
            ]

        ];

        if ($hideBackOrder) {
            $orderItemsConditions['back_order'] = 0;
            /*$orderItemsConditions[] = [
                function($query) {
                    $query->where('expected_date', '=', 'NULL');
                },
                null,
                null
            ];*/
        }

        if ($hideCancelled) {
            $orderItemsConditions['cancelled'] = 0;
        }

        /** @var \Illuminate\Database\Eloquent\Collection $shipmentItems */
        $shipmentItems = $this->customerOrderItems->with(['product', 'product.productGroup', 'product.packageType', 'customerOrder', 'customerShipment'])->findWhere($orderItemsConditions);

        /** @var \Illuminate\Database\Eloquent\Collection $orderDepositItems */
        $orderDepositItems = $shipmentItems->filter(function (CustomerOrderItem $shipmentItem) {
            return $shipmentItem->deposit_enabled;
        });

        $totalVats = get_total_vats($shipmentItems);
        $totalDeposits = get_total_deposits($shipmentItems);
        $totalPrice = $shipmentItems->sum('total_price') + $orderDepositItems->sum('deposit_total_price');
        $totalVatPrice = $shipmentItems->sum('total_vat_price') + $orderDepositItems->sum('deposit_total_vat_price');

        return compact(
            'company',
            'customer',
            'shipment',
            'shipmentItems',
            'totalVats',
            'totalDeposits',
            'totalPrice',
            'totalVatPrice'
        );
    }
}
