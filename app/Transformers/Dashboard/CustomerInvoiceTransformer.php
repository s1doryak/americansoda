<?php

namespace App\Transformers\Dashboard;

use App\CustomerInvoice;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerInvoice transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerInvoiceTransformer implements TransformerContract
{
    use Collector;

    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'maventa_id' => $request->get('maventa_id'),
            'maventa_tiff' => $request->file('maventa_tiff'),
            'maventa_initiated' => (boolean)$request->get('maventa_initiated'),
            'currency' => $request->get('currency'),
            'data' => $request->get('data'),
            'date' => $request->get('date'),
            'date_due' => $request->get('date_due'),
            'delivery_date' => $request->get('delivery_date'),
            'delivery_type' => $request->get('delivery_type'),
            'error_message' => $request->get('error_message'),
            'invoice_delivery_address' => $request->get('invoice_delivery_address'),
            'invoice_nr' => $request->get('invoice_nr'),
            'invoice_seller_information' => $request->get('invoice_seller_information'),
            'lang' => $request->get('lang'),
            'notes' => $request->get('notes'),
            'order_nr' => $request->get('order_nr'),
            'payment_terms' => $request->get('payment_terms'),
            'reference_nr' => $request->get('reference_nr'),
            'state' => (integer)$request->get('state'),
            'status' => $request->get('status'),
            'sum' => $request->get('sum'),
            'sum_tax' => $request->get('sum_tax'),
            'work_order_nr' => $request->get('work_order_nr'),
            'company_interest' => $request->get('company_interest'),
            'company_paper_fee' => $request->get('company_paper_fee'),
            'company_reminder' => $request->get('company_reminder'),
            'company_comment' => $request->get('company_comment'),
            'company_reference' => $request->get('company_reference'),
            'customer_nr' => $request->get('customer_nr'),
            'customer_email' => $request->get('customer_email'),
            'customer_name' => $request->get('customer_name'),
            'customer_country' => $request->get('customer_country'),
            'customer_state' => $request->get('customer_state'),
            'customer_post_code' => $request->get('customer_post_code'),
            'customer_post_office' => $request->get('customer_post_office'),
            'customer_address1' => $request->get('customer_address1'),
            'customer_address2' => $request->get('customer_address2'),
            'customer_contact_p' => $request->get('customer_contact_p'),
            'customer_bid' => $request->get('customer_bid'),
            'customer_ovt' => $request->get('customer_ovt'),
            'customer' => (integer)$request->get('customer'),
            'shipment' => (integer)$request->get('shipment'),
            'accounts' => (array)$request->get('accounts'),
            'maventa_paid' => (boolean)$request->get('maventa_paid'),
            'maventa_sent_at' => $request->get('maventa_sent_at'),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function transformUpdateRequest(Request $request)
    {
        return [
            'maventa_id' => $request->get('maventa_id'),
            'maventa_tiff' => $request->file('maventa_tiff'),
            'maventa_initiated' => (boolean)$request->get('maventa_initiated'),
            'currency' => $request->get('currency'),
            'data' => $request->get('data'),
            'date' => $request->get('date'),
            'date_due' => $request->get('date_due'),
            'delivery_date' => $request->get('delivery_date'),
            'delivery_type' => $request->get('delivery_type'),
            'error_message' => $request->get('error_message'),
            'invoice_delivery_address' => $request->get('invoice_delivery_address'),
            'invoice_nr' => $request->get('invoice_nr'),
            'invoice_seller_information' => $request->get('invoice_seller_information'),
            'lang' => $request->get('lang'),
            'notes' => $request->get('notes'),
            'order_nr' => $request->get('order_nr'),
            'payment_terms' => $request->get('payment_terms'),
            'reference_nr' => $request->get('reference_nr'),
            'state' => (integer)$request->get('state'),
            'status' => $request->get('status'),
            'sum' => $request->get('sum'),
            'sum_tax' => $request->get('sum_tax'),
            'work_order_nr' => $request->get('work_order_nr'),
            'company_interest' => $request->get('company_interest'),
            'company_paper_fee' => $request->get('company_paper_fee'),
            'company_reminder' => $request->get('company_reminder'),
            'company_comment' => $request->get('company_comment'),
            'company_reference' => $request->get('company_reference'),
            'customer_nr' => $request->get('customer_nr'),
            'customer_email' => $request->get('customer_email'),
            'customer_name' => $request->get('customer_name'),
            'customer_country' => $request->get('customer_country'),
            'customer_state' => $request->get('customer_state'),
            'customer_post_code' => $request->get('customer_post_code'),
            'customer_post_office' => $request->get('customer_post_office'),
            'customer_address1' => $request->get('customer_address1'),
            'customer_address2' => $request->get('customer_address2'),
            'customer_contact_p' => $request->get('customer_contact_p'),
            'customer_bid' => $request->get('customer_bid'),
            'customer_ovt' => $request->get('customer_ovt'),
            'customer' => (integer)$request->get('customer'),
            'shipment' => (integer)$request->get('shipment'),
            'accounts' => (array)$request->get('accounts'),
            'maventa_paid' => (boolean)$request->get('maventa_paid'),
            'maventa_sent_at' => $request->get('maventa_sent_at'),
        ];
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return array
     */
    public static function toArray($customerInvoice)
    {
        return [
            'id' => (int)$customerInvoice->getKey(),
            'maventa_id' => $customerInvoice->maventa_id,
            'maventa_tiff' => (string)$customerInvoice->maventa_tiff ? asset((string)$customerInvoice->maventa_tiff) : null,
            'maventa_initiated' => (boolean)$customerInvoice->maventa_initiated,
            'currency' => $customerInvoice->currency,
            'data' => $customerInvoice->data,
            'date' => $customerInvoice->date,
            'date_due' => $customerInvoice->date_due,
            'delivery_date' => $customerInvoice->delivery_date,
            'delivery_type' => $customerInvoice->delivery_type,
            'error_message' => $customerInvoice->error_message,
            'invoice_delivery_address' => $customerInvoice->invoice_delivery_address,
            'invoice_nr' => $customerInvoice->invoice_nr,
            'invoice_seller_information' => $customerInvoice->invoice_seller_information,
            'lang' => $customerInvoice->lang,
            'notes' => $customerInvoice->notes,
            'order_nr' => $customerInvoice->order_nr,
            'payment_terms' => $customerInvoice->payment_terms,
            'reference_nr' => $customerInvoice->reference_nr,
            'state' => (integer)$customerInvoice->state,
            'status' => $customerInvoice->status,
            'sum' => $customerInvoice->sum,
            'sum_tax' => $customerInvoice->sum_tax,
            'work_order_nr' => $customerInvoice->work_order_nr,
            'company_interest' => $customerInvoice->company_interest,
            'company_paper_fee' => $customerInvoice->company_paper_fee,
            'company_reminder' => $customerInvoice->company_reminder,
            'company_comment' => $customerInvoice->company_comment,
            'company_reference' => $customerInvoice->company_reference,
            'customer_nr' => $customerInvoice->customer_nr,
            'customer_email' => $customerInvoice->customer_email,
            'customer_name' => $customerInvoice->customer_name,
            'customer_country' => $customerInvoice->customer_country,
            'customer_state' => $customerInvoice->customer_state,
            'customer_post_code' => $customerInvoice->customer_post_code,
            'customer_post_office' => $customerInvoice->customer_post_office,
            'customer_address1' => $customerInvoice->customer_address1,
            'customer_address2' => $customerInvoice->customer_address2,
            'customer_contact_p' => $customerInvoice->customer_contact_p,
            'customer_bid' => $customerInvoice->customer_bid,
            'customer_ovt' => $customerInvoice->customer_ovt,
            'customer' => $customerInvoice->customer ? CustomerTransformer::toArray($customerInvoice->customer) : null,
            'shipment' => $customerInvoice->shipment ? CustomerShipmentTransformer::toArray($customerInvoice->shipment) : null,
            'accounts' => $customerInvoice->accounts ? CompanyBankAccountTransformer::map($customerInvoice->accounts) : [],
            'created_at' => (string)$customerInvoice->created_at,
            'updated_at' => (string)$customerInvoice->updated_at,
            'deleted_at' => (string)$customerInvoice->deleted_at,
            'maventa_paid' => (boolean)$customerInvoice->maventa_paid,
            'maventa_sent_at' => $customerInvoice->maventa_sent_at,
        ];
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return array
     */
    public static function toMaventaArray($customerInvoice)
    {
        $attachments = [
            [
                'filename' => sprintf('invoice_%d.pdf', $customerInvoice->invoice_nr),
                'attachment_type' => 'INVOICE_IMAGE',
                'file' => base64_encode(''),
            ]
        ];

        $bank_accounts = CompanyBankAccountTransformer::mapMaventa($customerInvoice->companyBankAccounts)->toArray();

        $customer = CustomerTransformer::toMaventaArray($customerInvoice->customer);

        $disabled_routes = [
            'paper' => false,
            'relay' => false,
            'email' => false
        ];

        $items = CustomerInvoiceItemTransformer::mapMaventa($customerInvoice->customerInvoiceItems)->toArray();

        return [
            'company_comment' => $customerInvoice->company_comment,
            'company_interest' => $customerInvoice->company_interest,
            'company_paper_fee' => $customerInvoice->company_paper_fee,
            'company_reference' => $customerInvoice->company_reference,
            'company_reminder' => $customerInvoice->company_reminder,
            'company_website' => null,
            'currency' => $customerInvoice->currency,
            'customer_maventa_id' => null,
            'customer_reference' => null,
            'date' => $customerInvoice->date,
            'date_due' => $customerInvoice->date_due,
            'delivery_date' => $customerInvoice->delivery_date,
            'delivery_type' => $customerInvoice->delivery_type,
            'invoice_delivery_address' => $customerInvoice->invoice_delivery_address,
            'invoice_nr' => $customerInvoice->invoice_nr,
            'invoice_seller_information' => $customerInvoice->invoice_seller_information,
            'lang' => $customerInvoice->lang,
            'notes' => $customerInvoice->notes,
            'order_nr' => $customerInvoice->order_nr,
            'payment_terms' => $customerInvoice->payment_terms,
            'reference_nr' => $customerInvoice->reference_nr,
            'require_sign' => false,
            'sum' => $customerInvoice->sum,
            'sum_tax' => $customerInvoice->sum_tax,
            'work_order_nr' => $customerInvoice->work_order_nr,

            # Assign customer and item info to invoice
            'attachments' => $attachments,
            'bank_accounts' => $bank_accounts,
            'customer' => $customer,
            'company_postal' => [],
            'data' => [],
            'disabled_routes' => $disabled_routes,
            'items' => $items,
        ];
    }
}
