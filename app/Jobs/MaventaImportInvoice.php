<?php

namespace App\Jobs;

use App\Company;
use App\CompanyBankAccount;
use App\CustomerInvoice;
use App\CustomerInvoiceAction;
use App\CustomerInvoiceAttachment;
use App\CustomerInvoiceItem;
use App\Repositories\Contracts\CompanyBankAccountRepository;
use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MaventaImportInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var object
     */
    public $invoice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @param CustomerInvoiceRepository $invoiceRepository
     * @param CustomerInvoiceActionRepository $invoiceActionRepository
     * @param CustomerInvoiceAttachmentRepository $invoiceAttachmentRepository
     * @param CustomerInvoiceItemRepository $invoiceItemRepository
     * @param CompanyBankAccountRepository $companyAccountRepository
     * @param CompanyRepository $companyRepository
     *
     * @return void|CustomerInvoice
     */
    public function handle(
        CustomerInvoiceRepository $invoiceRepository,
        CustomerInvoiceActionRepository $invoiceActionRepository,
        CustomerInvoiceAttachmentRepository $invoiceAttachmentRepository,
        CustomerInvoiceItemRepository $invoiceItemRepository,
        CompanyBankAccountRepository $companyAccountRepository,
        CompanyRepository $companyRepository
    )
    {
        /** @var Company $company */
        $company = $companyRepository->first();

        /** @var CustomerInvoice $invoice */
        $invoice = $invoiceRepository->firstOrCreate([
            'maventa_id' => $this->invoice->id
        ]);

        $invoice->update([
            'currency' => $this->invoice->currency,
            'data' => $this->invoice->data,
            'date' => $this->invoice->date,
            'date_due' => $this->invoice->date_due,
            'delivery_date' => $this->invoice->delivery_date,
            'delivery_type' => $this->invoice->delivery_type,
            'error_message' => $this->invoice->error_message,
            'invoice_delivery_address' => $this->invoice->invoice_delivery_address,
            'invoice_nr' => $this->invoice->invoice_nr,
            'invoice_seller_information' => $this->invoice->invoice_seller_information,
            'lang' => $this->invoice->lang,
            'notes' => $this->invoice->notes,
            'order_nr' => $this->invoice->order_nr,
            'payment_terms' => $this->invoice->payment_terms,
            'reference_nr' => $this->invoice->reference_nr,
            'state' => $this->invoice->state,
            'status' => $this->invoice->status,
            'sum' => $this->invoice->sum,
            'sum_tax' => $this->invoice->sum_tax,
            'work_order_nr' => $this->invoice->work_order_nr,
            'company_interest' => $this->invoice->company_interest,
            'company_paper_fee' => $this->invoice->company_paper_fee,
            'company_reminder' => $this->invoice->company_reminder,
            'company_comment' => $this->invoice->company_comment,
            'company_reference' => $this->invoice->company_reference,
            'customer_nr' => $this->invoice->customer_nr,
            'customer_email' => $this->invoice->customer_email,
            'customer_name' => $this->invoice->customer_name,
            'customer_country' => $this->invoice->customer_country,
            'customer_state' => $this->invoice->customer_state,
            'customer_post_code' => $this->invoice->customer_post_code,
            'customer_post_office' => $this->invoice->customer_post_office,
            'customer_address1' => $this->invoice->customer_address1,
            'customer_address2' => $this->invoice->customer_address2,
            'customer_contact_p' => $this->invoice->customer_contact_p,
            'customer_bid' => $this->invoice->customer_bid,
            'customer_ovt' => $this->invoice->customer_ovt,
        ]);

        foreach ((array)$this->invoice->items as $item) {

            /** @var CustomerInvoiceItem $invoiceItem */
            $invoiceItem = $invoiceItemRepository->firstOrCreate([
                'position' => $item->position,
                'customer_invoice_id' => $invoice->getKey(),
            ]);

            $invoiceItem->update([
                'position' => $item->position,
                'item_code' => $item->item_code,
                'subject' => $item->subject,
                'definition' => $item->definition,
                'price' => $item->price,
                'unit_type' => $item->unit_type,
                'amount' => $item->amount,
                'sum' => $item->sum,
                'tax' => $item->tax,
                'sum_tax' => $item->sum_tax,
                'discount' => $item->discount,

                //'customer_invoice_id' => $item->customer_invoice_id,
                //'customer_order_item_id' => $item->customer_order_item_id,
            ]);
        }

        if (isset($item)) {
            $invoiceItemRepository->destroyWhere([
                ['position', '>', $item->position],
                ['customer_invoice_id', '=', $invoice->getKey()],
            ]);
        }

        foreach ((array)$this->invoice->accounts as $account) {

            $companyAccounts = collect();

            /** @var CompanyBankAccount $companyAccount */
            $companyAccount = $companyAccountRepository->firstOrCreate([
                'bank' => $account->bank,
                'swift' => $account->swift,
                'account' => $account->account,
                'iban' => $account->iban,
            ]);

            if ($companyAccount->wasRecentlyCreated) {
                $companyAccount->company()->associate($company);
                $companyAccount->save();
            }

            $companyAccounts->push($companyAccount);
        }

        // $invoice->accounts()->sync($companyAccounts);

        foreach ((array)$this->invoice->actions as $action) {
            /** @var CustomerInvoiceAction $invoiceAction */
            $invoiceAction = $invoiceActionRepository->firstOrCreate([
                'action' => $action->action,
                'timestamp' => Carbon::parse($action->timestamp),
                'customer_invoice_id' => $invoice->getKey(),
            ]);
        }

        foreach ((array)$this->invoice->attachments as $attachment) {
            /** @var CustomerInvoiceAttachment $invoiceAttachment */
            $invoiceAttachment = $invoiceAttachmentRepository->firstOrCreate([
                'attachment_type' => $attachment->attachment_type,
                'filename' => $attachment->filename,
                'customer_invoice_id' => $invoice->getKey(),
            ]);

            $invoiceAttachment->update([
                'file' => $attachment->file
            ]);
        }

        $invoice->update([
            'maventa_initiated' => true
        ]);

        $invoice->load([
            'items',
            'actions',
            'accounts',
            'attachments',
            'customer',
            'shipment',
        ]);

        return $invoice;
    }
}
