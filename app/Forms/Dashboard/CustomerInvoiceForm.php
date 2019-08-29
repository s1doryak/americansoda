<?php

namespace App\Forms\Dashboard;

use App\CustomerInvoice;
use App\CustomerInvoiceItem;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerInvoice form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerInvoiceForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			//'maventa_id' => 'text',
			//'maventa_tiff' => 'file',
			//'maventa_initiated' => 'checkbox',
			//'currency' => 'text',
			//'data' => 'text',
			'date' => 'text',
			'date_due' => 'text',
			//'delivery_date' => 'text',
			//'delivery_type' => 'text',
			//'error_message' => 'text',
			//'invoice_delivery_address' => 'text',
			'invoice_nr' => 'text',
			//'invoice_seller_information' => 'text',
			//'lang' => 'text',
			'notes' => 'text',
			'order_nr' => 'text',
			'payment_terms' => 'text',
			'reference_nr' => 'text',
			//'state' => 'number',
			//'status' => 'text',
			//'sum' => 'text',
			//'sum_tax' => 'text',
			//'work_order_nr' => 'text',
			//'company_interest' => 'text',
			//'company_paper_fee' => 'text',
			//'company_reminder' => 'text',
			//'company_comment' => 'text',
			//'company_reference' => 'text',
			//'customer_nr' => 'text',
			//'customer_email' => 'text',
			//'customer_name' => 'text',
			//'customer_country' => 'text',
			//'customer_state' => 'text',
			//'customer_post_code' => 'text',
			//'customer_post_office' => 'text',
			//'customer_address1' => 'text',
			//'customer_address2' => 'text',
			//'customer_contact_p' => 'text',
			//'customer_bid' => 'text',
			//'customer_ovt' => 'text',
			'customer' => 'choice',
			'customerShipment' => [
			    'type' => 'choice',
                'lists' => 'number',
            ],
			'companyBankAccounts' => 'choice',
            'customerInvoiceItems[0]' => [
                'type' => 'relation_form',
                'fields' => CustomerInvoiceItemForm::getCreateFormFields(),
                'form_title' => trans('models/customer_invoice_item.labels.plural'),
                'resource' => 'customer_invoice_item',
                'items' => [],
                'can_add' => true,
                'can_edit' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
                'can_remove' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
                'can_select' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
            ]
        ];
	}

    /**
     * @param CustomerInvoice $customerInvoice
     * @return array
     */
	public static function getEditFormFields($customerInvoice)
	{
        return [
            //'maventa_id' => 'text',
            //'maventa_tiff' => 'file',
            //'maventa_initiated' => 'checkbox',
            //'currency' => 'text',
            //'data' => 'text',
            'date' => 'text',
            'date_due' => 'text',
            //'delivery_date' => 'text',
            //'delivery_type' => 'text',
            //'error_message' => 'text',
            //'invoice_delivery_address' => 'text',
            'invoice_nr' => 'text',
            //'invoice_seller_information' => 'text',
            //'lang' => 'text',
            'notes' => 'text',
            'order_nr' => 'text',
            'payment_terms' => 'text',
            'reference_nr' => 'text',
            //'state' => 'number',
            //'status' => 'text',
            //'sum' => 'text',
            //'sum_tax' => 'text',
            //'work_order_nr' => 'text',
            //'company_interest' => 'text',
            //'company_paper_fee' => 'text',
            //'company_reminder' => 'text',
            //'company_comment' => 'text',
            //'company_reference' => 'text',
            //'customer_nr' => 'text',
            //'customer_email' => 'text',
            //'customer_name' => 'text',
            //'customer_country' => 'text',
            //'customer_state' => 'text',
            //'customer_post_code' => 'text',
            //'customer_post_office' => 'text',
            //'customer_address1' => 'text',
            //'customer_address2' => 'text',
            //'customer_contact_p' => 'text',
            //'customer_bid' => 'text',
            //'customer_ovt' => 'text',
            'customer' => 'choice',
            'customerShipment' => [
                'type' => 'choice',
                'lists' => 'number',
            ],
            'companyBankAccounts' => 'choice',
            'customerInvoiceItems[0]' => [
                'type' => 'relation_form',
                'fields' => CustomerInvoiceItemForm::getCreateFormFields(),
                'form_title' => trans('models/customer_invoice_item.labels.plural'),
                'resource' => 'customer_invoice_item',
                'items' => $customerInvoice->customerInvoiceItems,
                'can_add' => true,
                'can_edit' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
                'can_remove' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
                'can_select' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
            ]
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'maventa_id' => 'sometimes',
			'maventa_tiff' => 'sometimes',
			'maventa_initiated' => 'sometimes',
			'currency' => 'sometimes',
			'data' => 'sometimes',
			'date' => 'sometimes',
			'date_due' => 'sometimes',
			'delivery_date' => 'sometimes',
			'delivery_type' => 'sometimes',
			'error_message' => 'sometimes',
			'invoice_delivery_address' => 'sometimes',
			'invoice_nr' => 'sometimes',
			'invoice_seller_information' => 'sometimes',
			'lang' => 'sometimes',
			'notes' => 'sometimes',
			'order_nr' => 'sometimes',
			'payment_terms' => 'sometimes',
			'reference_nr' => 'sometimes',
			'state' => 'sometimes',
			'status' => 'sometimes',
			'sum' => 'sometimes',
			'sum_tax' => 'sometimes',
			'work_order_nr' => 'sometimes',
			'company_interest' => 'sometimes',
			'company_paper_fee' => 'sometimes',
			'company_reminder' => 'sometimes',
			'company_comment' => 'sometimes',
			'company_reference' => 'sometimes',
			'customer_nr' => 'sometimes',
			'customer_email' => 'sometimes',
			'customer_name' => 'sometimes',
			'customer_country' => 'sometimes',
			'customer_state' => 'sometimes',
			'customer_post_code' => 'sometimes',
			'customer_post_office' => 'sometimes',
			'customer_address1' => 'sometimes',
			'customer_address2' => 'sometimes',
			'customer_contact_p' => 'sometimes',
			'customer_bid' => 'sometimes',
			'customer_ovt' => 'sometimes',
			'customer' => 'sometimes|exists:customers,id',
			'customerShipment' => 'sometimes|exists:customer_shipments,id',
			'companyBankAccounts' => 'sometimes|exists:company_bank_accounts,id',
        ];
	}

    /**
     * @param CustomerInvoice $customerInvoice
     * @return array
     */
	public static function getUpdateValidationRules($customerInvoice)
	{
        return [
			'maventa_id' => 'sometimes',
			'maventa_tiff' => 'sometimes',
			'maventa_initiated' => 'sometimes',
			'currency' => 'sometimes',
			'data' => 'sometimes',
			'date' => 'sometimes',
			'date_due' => 'sometimes',
			'delivery_date' => 'sometimes',
			'delivery_type' => 'sometimes',
			'error_message' => 'sometimes',
			'invoice_delivery_address' => 'sometimes',
			'invoice_nr' => 'sometimes',
			'invoice_seller_information' => 'sometimes',
			'lang' => 'sometimes',
			'notes' => 'sometimes',
			'order_nr' => 'sometimes',
			'payment_terms' => 'sometimes',
			'reference_nr' => 'sometimes',
			'state' => 'sometimes',
			'status' => 'sometimes',
			'sum' => 'sometimes',
			'sum_tax' => 'sometimes',
			'work_order_nr' => 'sometimes',
			'company_interest' => 'sometimes',
			'company_paper_fee' => 'sometimes',
			'company_reminder' => 'sometimes',
			'company_comment' => 'sometimes',
			'company_reference' => 'sometimes',
			'customer_nr' => 'sometimes',
			'customer_email' => 'sometimes',
			'customer_name' => 'sometimes',
			'customer_country' => 'sometimes',
			'customer_state' => 'sometimes',
			'customer_post_code' => 'sometimes',
			'customer_post_office' => 'sometimes',
			'customer_address1' => 'sometimes',
			'customer_address2' => 'sometimes',
			'customer_contact_p' => 'sometimes',
			'customer_bid' => 'sometimes',
			'customer_ovt' => 'sometimes',
			'customer' => 'sometimes|exists:customers,id',
			'customerShipment' => 'sometimes|exists:customer_shipments,id',
			'companyBankAccounts' => 'sometimes|exists:company_bank_accounts,id',
        ];
	}
}
