<?php

namespace App\Jobs;

use App\Company;
use App\CompanyBankAccount;
use App\Customer;
use App\CustomerInvoice;
use App\CustomerInvoiceAction;
use App\CustomerInvoiceAttachment;
use App\CustomerInvoiceItem;
use App\CustomerOrder;
use App\CustomerOrderItem;
use App\CustomerShipment;
use App\Product;
use App\Repositories\Contracts\CompanyBankAccountRepository;
use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use Carbon\Carbon;
use Crmplease\Maventa\Exceptions\Exception;
use Crmplease\Maventa\Maventa;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;

class MaventaImportInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    public $id;

    /**
     * @var boolean
     */
    public $tiff;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $tiff)
    {
        $this->id = $id;
        $this->tiff = $tiff;
    }

    /**
     * Execute the job.
     *
     * @param Maventa $maventa
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     * @param CustomerInvoiceActionRepository $customerInvoiceActionRepository
     * @param CustomerInvoiceAttachmentRepository $customerInvoiceAttachmentRepository
     * @param CustomerInvoiceItemRepository $customerInvoiceItemRepository
     * @param CustomerOrderRepository $customerOrderRepository
     * @param CompanyBankAccountRepository $companyBankAccountRepository
     * @param CompanyRepository $companyRepository
     *
     * @return void|CustomerInvoice
     * @throws Exception
     */
    public function handle(
        Maventa $maventa,
        CustomerInvoiceRepository $customerInvoiceRepository,
        CustomerInvoiceActionRepository $customerInvoiceActionRepository,
        CustomerInvoiceAttachmentRepository $customerInvoiceAttachmentRepository,
        CustomerInvoiceItemRepository $customerInvoiceItemRepository,
        CustomerOrderRepository $customerOrderRepository,
        CompanyBankAccountRepository $companyBankAccountRepository,
        CompanyRepository $companyRepository
    )
    {
        /** @var object $invoice */
        $invoice = $maventa->invoice_show($this->id);

        if ($invoice->status !== 'OK') {
            throw new Exception(sprintf("%s (ID: %s)", $invoice->status, $this->id));
        }

        /** @var Company $company */
        $company = $companyRepository->find(1);

        /** @var CustomerInvoice $customerInvoice */
        $customerInvoice = $customerInvoiceRepository->firstOrCreate([
            'maventa_id' => $invoice->id
        ]);

        $customerInvoice->update([
            'currency' => $invoice->currency,
            'data' => $invoice->data,
            'date' => $invoice->date,
            'date_due' => $invoice->date_due,
            'delivery_date' => $invoice->delivery_date,
            'delivery_type' => $invoice->delivery_type,
            'error_message' => $invoice->error_message,
            'invoice_delivery_address' => $invoice->invoice_delivery_address,
            'invoice_nr' => $invoice->invoice_nr,
            'invoice_seller_information' => $invoice->invoice_seller_information,
            'lang' => $invoice->lang,
            'notes' => $invoice->notes,
            'order_nr' => $invoice->order_nr,
            'payment_terms' => $invoice->payment_terms,
            'reference_nr' => $invoice->reference_nr,
            'state' => $invoice->state,
            'status' => $invoice->status,
            'sum' => $invoice->sum,
            'sum_tax' => $invoice->sum_tax,
            'work_order_nr' => $invoice->work_order_nr,
            'company_interest' => $invoice->company_interest,
            'company_paper_fee' => $invoice->company_paper_fee,
            'company_reminder' => $invoice->company_reminder,
            'company_comment' => $invoice->company_comment,
            'company_reference' => $invoice->company_reference,
            'customer_nr' => $invoice->customer_nr,
            'customer_email' => $invoice->customer_email,
            'customer_name' => $invoice->customer_name,
            'customer_country' => $invoice->customer_country,
            'customer_state' => $invoice->customer_state,
            'customer_post_code' => $invoice->customer_post_code,
            'customer_post_office' => $invoice->customer_post_office,
            'customer_address1' => $invoice->customer_address1,
            'customer_address2' => $invoice->customer_address2,
            'customer_contact_p' => $invoice->customer_contact_p,
            'customer_bid' => $invoice->customer_bid,
            'customer_ovt' => $invoice->customer_ovt,

            'maventa_initiated' => true,
            'maventa_sent_at' => carbon($invoice->date, 'Ymd')->endOfDay()
        ]);

        /**
         * Присвоение клиента по номеру заказа.
         */
        if (Str::contains($invoice->order_nr, 'SODA-')) {

            $invoice_nr = collect(preg_split('/[^A-Z0-9\-]/', $invoice->order_nr, PREG_SPLIT_NO_EMPTY))->first();

            /** @var CustomerOrder|null $customerOrder */
            $customerOrder = $customerOrderRepository->with(['customer', 'customer.customerShipments'])->firstWhere([
                'number' => $invoice_nr
            ]);

            if ($customerOrder) {

                /** @var Customer|null $customer */
                $customer = $customerOrder->customer;

                if ($customer) {

                    $customer->update([
                        'nr' => $customer->nr ?: $invoice->customer_nr,
                        'email' => $customer->email ?: $invoice->customer_email,
                        'name' => $customer->name ?: $invoice->customer_contact_p,
                        'legal_name' => $customer->legal_name ?: $invoice->customer_name,
                        'y_tunnus' => $customer->y_tunnus ?: $customer->bid ?: $invoice->customer_bid,
                        'country' => $customer->country ?: $invoice->customer_country,
                        'state' => $customer->state ?: $invoice->customer_state,
                        'post_code' => $customer->post_code ?: $invoice->customer_post_code,
                        'post_office' => $customer->post_office ?: $invoice->customer_post_office,
                        'address1' => $customer->address1 ?: $invoice->customer_address1,
                        'address2' => $customer->address2 ?: $invoice->customer_address2,
                        'contact_p' => $customer->contact_p ?: $invoice->customer_contact_p,
                        'bid' => $customer->bid ?: $invoice->customer_bid,
                        'ovt' => $customer->ovt ?: $invoice->customer_ovt,
                    ]);

                    $customerInvoice->customer()->associate($customer);
                    $customerInvoice->save();

                    /** @var CustomerShipment|null $customerShipment */
                    $customerShipment = $customer->customerShipments->first(function (CustomerShipment $customerShipment) use ($invoice) {
                        return $customerShipment->number === $invoice->company_reference;
                    });

                    if ($customerShipment) {
                        $customerInvoice->customerShipment()->associate($customerShipment);
                        $customerInvoice->save();
                    }
                }
            }
        }

        /**
         * Импорт строк заказа.
         */
        if (isset($invoice->items)) {

            foreach ((array)$invoice->items as $item) {

                /** @var CustomerInvoiceItem $customerInvoiceItem */
                $customerInvoiceItem = $customerInvoiceItemRepository->firstOrCreate([
                    'position' => $item->position,
                    'customer_invoice_id' => $customerInvoice->getKey(),
                ]);

                $customerInvoiceItem->update([
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
                ]);

                if (isset($customerOrder)) {
                    /** @var CustomerOrderItem|null $customerOrderItem */
                    $customerOrderItem = $customerOrder->customerOrderItems->first(function (CustomerOrderItem $customerOrderItem) use ($item) {
                        return $customerOrderItem->product->name === $item->subject;
                    });

                    if ($customerOrderItem) {
                        $customerInvoiceItem->customerOrderItem()->associate($customerOrderItem);

                        /** @var Product|null $product */
                        $product = $customerOrderItem->product;

                        if ($product) {

                            $product->update([
                                'comment' => !empty(trim(strip_tags($product->comment))) ? trim(strip_tags($product->comment)) : '',
                                'contents' => !empty(trim(strip_tags($product->contents))) ? trim(strip_tags($product->contents)) : '',
                                'description' => !empty(trim(strip_tags($product->description))) ? trim(strip_tags($product->description)) : $item->definition,
                                'unit_type' => !empty(trim(strip_tags($product->unit_type))) ? trim(strip_tags($product->unit_type)) : $item->unit_type,
                            ]);

                            $customerInvoiceItem->product()->associate($product);
                        }
                    }

                    $customerInvoiceItem->save();
                }
            }

            /**
             *  Удалить позиции, которых нет в счете.
             */
            if (isset($item)) {
                $customerInvoiceItemRepository->destroyWhere([
                    ['position', '>', $item->position],
                    ['customer_invoice_id', '=', $customerInvoice->getKey()],
                ]);
            }
        }

        /**
         * Импорт банковских счетов компании
         */
        if (isset($invoice->actions)) {

            foreach ((array)$invoice->accounts as $account) {

                $companyBankAccounts = collect();

                /** @var CompanyBankAccount $companyBankAccount */
                $companyBankAccount = $companyBankAccountRepository->firstOrCreate([
                    'bank' => $account->bank,
                    'swift' => $account->swift,
                    'account' => $account->account,
                    'iban' => $account->iban,
                ]);

                if ($companyBankAccount->wasRecentlyCreated) {
                    if ($company->companyBankAccounts->count() === 0) {
                        $companyBankAccount->update([
                            'default' => true
                        ]);
                    }
                    $companyBankAccount->company()->associate($company);
                    $companyBankAccount->save();
                }

                $companyBankAccounts->push($companyBankAccount);
            }

            $customerInvoice->companyBankAccounts()->sync($companyBankAccounts->pluck('id'));

        }

        /**
         * Импорт действий со счетами.
         */
        if (isset($invoice->actions)) {

            foreach ((array)$invoice->actions as $action) {
                /** @var CustomerInvoiceAction $customerInvoiceAction */
                $customerInvoiceAction = $customerInvoiceActionRepository->firstOrCreate([
                    'action' => $action->action,
                    'timestamp' => Carbon::parse($action->timestamp),
                    'customer_invoice_id' => $customerInvoice->getKey(),
                ]);
            }
        }

        /**
         * Импорт вложений
         */
        if (isset($invoice->attachments)) {

            foreach ((array)$invoice->attachments as $attachment) {
                /** @var CustomerInvoiceAttachment $customerInvoiceAttachment */
                $customerInvoiceAttachment = $customerInvoiceAttachmentRepository->firstOrCreate([
                    'attachment_type' => $attachment->attachment_type,
                    'filename' => $attachment->filename,
                    'customer_invoice_id' => $customerInvoice->getKey(),
                ]);

                $customerInvoiceAttachment->update([
                    'file' => $attachment->file
                ]);
            }
        }

        /**
         * Импорт изображения счета.
         */
        if ($this->tiff) {
            \App\Jobs\MaventaImportInvoiceImage::dispatch($this->id);
        }

        $customerInvoice->load([
            'companyBankAccounts',
            'customer',
            'customerShipment',
            'customerInvoiceItems',
            'customerInvoiceActions',
            'customerInvoiceAttachments',
        ]);

        return $customerInvoice;
    }
}
