<?php

namespace App\Services\Api\V1;

use App\Company;
use App\CompanyBankAccount;
use App\Customer;
use App\CustomerInvoice;
use App\Repositories\Eloquent\CompanyRepositoryEloquent;
use App\Repositories\Eloquent\CustomerInvoiceRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Http\Response;
use PDF;
use Prettus\Repository\Exceptions\RepositoryException;

class CustomerInvoiceService extends ResourceService
{
    /**
     * @var CustomerInvoiceRepositoryEloquent
     */
    public $repository;

    /**
     * @var CompanyRepositoryEloquent
     */
    protected $companyService;

    /**
     * @param CustomerInvoiceRepositoryEloquent $customerInvoiceRepository
     * @param CompanyRepositoryEloquent $companyService
     */
    public function __construct(
        CustomerInvoiceRepositoryEloquent $customerInvoiceRepository,
        CompanyService $companyService
    )
    {
        $this->repository = $customerInvoiceRepository;
        $this->companyService = $companyService;
    }

    /**
     * @param integer $shipmentId
     * @param boolean $inline
     * @return Response
     * @throws RepositoryException
     */
    public function getPdfFile($shipmentId, $inline = false)
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
            ->firstWhere([
                'customer_shipment_id' => $shipmentId
            ]);

        $pdf = PDF::loadView('dashboard::documents.invoice', $this->getDocumentData($customerInvoice));

        $filename = preg_replace('/\s+/mui', '_', sprintf('%s_%s_%s_%s.pdf', $customerInvoice->id, $customerInvoice->invoice_nr, $customerInvoice->customer->name, mb_strtoupper('Lasku')));

        return $pdf->inline($filename);
    }

    /**
     * @param CustomerInvoice $invoice
     * @return array
     */
    protected function getDocumentData($invoice)
    {
        /** @var Company $company */
        $company = $this->companyService->with('region')->first();

        /** @var CompanyBankAccount $companyBankAccount */
        $companyBankAccount = $company->companyBankAccounts->first(function (CompanyBankAccount $companyBankAccount) {
            return $companyBankAccount->default;
        });


        /** @var Customer $customer */
        $customer = $invoice->customer;

        $invoiceItems = $invoice->customerInvoiceItems;

        $totalVats = get_total_vats($invoiceItems);
        $totalDeposits = get_total_deposits($invoiceItems);
        $totalPrice = $invoiceItems->sum('sum');
        $totalVatPrice = $invoiceItems->sum('sum_tax');

        return compact(
            'company',
            'companyBankAccount',
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
