<?php

namespace App\Forms\Dashboard;

use App\Customer;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Customer form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'name' => 'text',
				'legal_name' => 'text',
				'billing_postcode' => 'text',
				'billing_address' => 'text',
				'shipping_postcode' => 'text',
				'shipping_address' => 'text',
				'bid' => 'text',
				'iban' => 'text',
				'swift' => 'text',
				'email' => 'text',
				'phone' => 'text',
				'order_interval' => 'number',
				'comment' => 'editor',
				'calendar_comment' => 'editor',
				'incomterms' => 'text',
				'terms_of_cooperation' => 'textarea',
				'terms_of_delivery' => 'textarea',
				'terms_of_equipment' => 'textarea',
				'delivery_payer' => 'text',
				'payment_conditions' => 'text',
				'pays_vat' => 'checkbox',
				'stock' => 'choice',
				'customerType' => 'choice',
				'paymentType' => 'choice',
				'user' => 'choice',
				'billingRegion' => 'choice',
				'shippingRegion' => 'choice',
        ];
	}

    /**
     * @param Customer $customer
     * @return array
     */
	public static function getEditFormFields($customer)
	{
        return [
				'name' => 'text',
				'legal_name' => 'text',
				'billing_postcode' => 'text',
				'billing_address' => 'text',
				'shipping_postcode' => 'text',
				'shipping_address' => 'text',
				'bid' => 'text',
				'iban' => 'text',
				'swift' => 'text',
				'email' => 'text',
				'phone' => 'text',
				'order_interval' => 'number',
				'comment' => 'editor',
				'calendar_comment' => 'editor',
				'incomterms' => 'text',
				'terms_of_cooperation' => 'textarea',
				'terms_of_delivery' => 'textarea',
				'terms_of_equipment' => 'textarea',
				'delivery_payer' => 'text',
				'payment_conditions' => 'text',
				'pays_vat' => 'checkbox',
				'stock' => 'choice',
				'customerType' => 'choice',
				'paymentType' => 'choice',
				'user' => 'choice',
				'billingRegion' => 'choice',
				'shippingRegion' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
			'legal_name' => 'sometimes',
			'billing_postcode' => 'sometimes',
			'billing_address' => 'sometimes',
			'shipping_postcode' => 'sometimes',
			'shipping_address' => 'sometimes',
			'bid' => 'sometimes',
			'iban' => 'sometimes',
			'swift' => 'sometimes',
			'email' => 'sometimes',
			'phone' => 'sometimes',
			'order_interval' => 'sometimes',
			'comment' => 'sometimes',
			'calendar_comment' => 'sometimes',
			'incomterms' => 'sometimes',
			'terms_of_cooperation' => 'sometimes',
			'terms_of_delivery' => 'sometimes',
			'terms_of_equipment' => 'sometimes',
			'delivery_payer' => 'sometimes',
			'payment_conditions' => 'sometimes',
			'pays_vat' => 'sometimes',
			'stock' => 'sometimes|exists:stocks,id',
			'customerType' => 'sometimes|exists:customer_types,id',
			'paymentType' => 'sometimes|exists:payment_types,id',
			'user' => 'sometimes|exists:users,id',
			'billingRegion' => 'sometimes|exists:regions,id',
			'shippingRegion' => 'sometimes|exists:regions,id',
        ];
	}

    /**
     * @param Customer $customer
     * @return array
     */
	public static function getUpdateValidationRules($customer)
	{
        return [
			'name' => 'sometimes',
			'legal_name' => 'sometimes',
			'billing_postcode' => 'sometimes',
			'billing_address' => 'sometimes',
			'shipping_postcode' => 'sometimes',
			'shipping_address' => 'sometimes',
			'bid' => 'sometimes',
			'iban' => 'sometimes',
			'swift' => 'sometimes',
			'email' => 'sometimes',
			'phone' => 'sometimes',
			'order_interval' => 'sometimes',
			'comment' => 'sometimes',
			'calendar_comment' => 'sometimes',
			'incomterms' => 'sometimes',
			'terms_of_cooperation' => 'sometimes',
			'terms_of_delivery' => 'sometimes',
			'terms_of_equipment' => 'sometimes',
			'delivery_payer' => 'sometimes',
			'payment_conditions' => 'sometimes',
			'pays_vat' => 'sometimes',
			'stock' => 'sometimes|exists:stocks,id',
			'customerType' => 'sometimes|exists:customer_types,id',
			'paymentType' => 'sometimes|exists:payment_types,id',
			'user' => 'sometimes|exists:users,id',
			'billingRegion' => 'sometimes|exists:regions,id',
			'shippingRegion' => 'sometimes|exists:regions,id',
        ];
	}
}