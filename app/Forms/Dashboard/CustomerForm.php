<?php

namespace App\Forms\Dashboard;

use App\Customer;
use App\Repositories\Contracts\ProductGroupRepository;
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
		$incomterms = config('customer.incomterms');
		$delivery_payer = config('customer.delivery_payer');

		$fields = [
			'name' => 'text',
			'legal_name' => 'text',

			'billingRegion' => [
				'type' => 'choice',
				'multiple' => false,
				'resource' => 'region',
				'selected' => null,
			],
			'billing_postcode' => 'text',
			'billing_address' => 'text',

			'shippingRegion' => [
				'type' => 'choice',
				'multiple' => false,
				'resource' => 'region',
				'selected' => null,
			],
			'shipping_postcode' => 'text',
			'shipping_address' => 'text',

			'bid' => 'text', // Business ID
			'iban' => 'text',
			'swift' => 'text',
			'email' => 'text',
			'phone' => 'text',
			'user' => [
				'type' => 'choice',
				'multiple' => false,
			],
			'stock' => [
				'type' => 'choice',
				'multiple' => false,
			],
			'customerType' => [
				'type' => 'choice',
				'multiple' => false,
			],
			'paymentType' => [
				'type' => 'choice',
				'multiple' => false,
			],
			'payment_conditions' => 'text',
			'pays_vat' => [
				'type' => 'hidden',
				'value' => true
			],
			'order_interval' => 'text',
			'delivery_payer' => [
				'type' => 'select',
				'choices' => array_combine($delivery_payer, $delivery_payer),
				'selected' => null,
			],
			'incomterms' => [
				'type' => 'select',
				'choices' => array_combine($incomterms, $incomterms),
				'selected' => null,
			],
			'comment' => 'editor',
			'terms_of_cooperation' => 'editor',
			'terms_of_delivery' => 'editor',
			'terms_of_equipment' => 'editor',
		];

		$policies = [
			'type' => 'relation_form',
			'resource' => 'customer_pricing_policy',
			'form_title' => trans('models/customer_pricing_policy.labels.plural'),
			'template' => 'dashboard::resources.customers.policies.form',
			'groups' => app(ProductGroupRepository::class)->all(),
			'fields' => CustomerPricingPolicyForm::getFormFields(),
			'items' => collect([]),
		];

		$fields['customerPricingPolicies[0]'] = $policies;

		return $fields;
	}

	/**
	 * @param Customer $customer
	 * @return array
	 */
	public static function getEditFormFields($customer)
	{
		$incomterms = config('customer.incomterms');
		$delivery_payer = config('customer.delivery_payer');

		$fields = [
			'name' => 'text',
			'legal_name' => 'text',

			'billingRegion' => [
				'type' => 'choice',
				'multiple' => false,
				'resource' => 'region',
				'selected' => $customer ? $customer->billingRegion->getKey() : null,
			],
			'billing_postcode' => 'text',
			'billing_address' => 'text',

			'shippingRegion' => [
				'type' => 'choice',
				'multiple' => false,
				'resource' => 'region',
				'selected' => $customer ? $customer->shippingRegion->getKey() : null,
			],
			'shipping_postcode' => 'text',
			'shipping_address' => 'text',

			'bid' => 'text', // Business ID
			'iban' => 'text',
			'swift' => 'text',
			'email' => 'text',
			'phone' => 'text',
			'user' => [
				'type' => 'choice',
				'multiple' => false,
			],
			'stock' => [
				'type' => 'choice',
				'multiple' => false,
			],
			'customerType' => [
				'type' => 'choice',
				'multiple' => false,
			],
			'paymentType' => [
				'type' => 'choice',
				'multiple' => false,
			],
			'payment_conditions' => 'text',
			'pays_vat' => [
				'type' => 'hidden',
				'value' => true
			],
			'order_interval' => 'text',
			'delivery_payer' => [
				'type' => 'select',
				'choices' => array_combine($delivery_payer, $delivery_payer),
				'selected' => $customer ? $customer->delivery_payer : null,
			],
			'incomterms' => [
				'type' => 'select',
				'choices' => array_combine($incomterms, $incomterms),
				'selected' => $customer ? $customer->incomterms : null,
			],
			'comment' => 'editor',
			'terms_of_cooperation' => 'editor',
			'terms_of_delivery' => 'editor',
			'terms_of_equipment' => 'editor',
		];

		$policies = [
			'type' => 'relation_form',
			'resource' => 'customer_pricing_policy',
			'form_title' => trans('models/customer_pricing_policy.labels.plural'),
			'template' => 'dashboard::resources.customers.policies.form',
			'groups' => app(ProductGroupRepository::class)->all(),
			'fields' => CustomerPricingPolicyForm::getFormFields(),
			'items' => $customer->customerPricingPolicies,
		];

		$fields['customerPricingPolicies[0]'] = $policies;

		return $fields;
	}

	/**
	 * @return array
	 */
	public static function getStoreValidationRules()
	{
		return [
			'name' => 'required',
			'legal_name' => 'required',

			'billingRegion' => 'required|exists:regions,id',
			'billing_postcode' => 'required',
			'billing_address' => 'required',

			'shippingRegion' => 'required|exists:regions,id',
			'shipping_postcode' => 'required',
			'shipping_address' => 'required',

			'bid' => 'required', // Business ID
			'email' => 'sometimes|email',
			'stock' => 'required|exists:stocks,id',
			'customerType' => 'required|exists:customer_types,id',
			'paymentType' => 'required|exists:payment_types,id',
			'user' => 'required|exists:users,id',
		];
	}

	/**
	 * @param Customer $customer
	 * @return array
	 */
	public static function getUpdateValidationRules($customer)
	{
		return [
			'name' => 'required',
			'legal_name' => 'required',

			'billingRegion' => 'required|exists:regions,id',
			'billing_postcode' => 'required',
			'billing_address' => 'required',

			'shippingRegion' => 'required|exists:regions,id',
			'shipping_postcode' => 'required',
			'shipping_address' => 'required',

			'bid' => 'required', // Business ID
			'email' => 'sometimes|email',
			'stock' => 'required|exists:stocks,id',
			'customerType' => 'required|exists:customer_types,id',
			'paymentType' => 'required|exists:payment_types,id',
			'user' => 'required|exists:users,id',
		];
	}
}