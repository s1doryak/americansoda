<?php

namespace App\Services\Api\V1;

use App\Company;
use App\Customer;
use App\CustomerInvoice;
use App\Repositories\Eloquent\CompanyRepositoryEloquent;
use App\Repositories\Eloquent\CustomerInvoiceRepositoryEloquent;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Services\ResourceService;
use PDF;

class CustomerInvoiceService extends ResourceService
{
    /**
     * @var CustomerInvoiceRepositoryEloquent
     */
    public $repository;

    /**
     * @var CompanyRepositoryEloquent
     */
    protected $companyRepository;

    public function __construct(
        CustomerInvoiceRepositoryEloquent $customerInvoiceRepository,
        CompanyRepositoryEloquent $companyRepository
    )
    {
        $this->repository = $customerInvoiceRepository;
        $this->companyRepository = $companyRepository;
    }

    public function downloadPdfFile($shipmentId, $inline = false)
    {
        /** @var CustomerInvoice $customerInvoice */
        $customerInvoice = $this
            ->repository
            ->with([
                'customer',
                'customer.billingRegion',
                'customer.shippingRegion',
                'customer.user',
                'customer.stock',
                'customer.stock.region'
            ])
            ->firstWhere(
            ['customer_shipment_id' => $shipmentId]
        );

        $filename = preg_replace('/\s+/mui', '_', sprintf('%s_%s_%s_%s.pdf', $customerInvoice->id, $customerInvoice->invoice_nr, $customerInvoice->customer->name, mb_strtoupper('Laskufaktura')));

        return PDF::loadView('dashboard::documents.invoice', $this->getDocumentData($customerInvoice))
            ->inline($filename)
            ->send();
    }

    /**
     * @param CustomerInvoice $invoice
     * @return array
     */
    protected function getDocumentData($invoice)
    {
        /** @var Company $company */
        $company = $this->companyRepository->with('region')->first();

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
}