<?php

namespace App\Transformers\Dashboard;

use App\Customer;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Customer transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'name' => $request->get('name'),
			'legal_name' => $request->get('legal_name'),
			'billing_postcode' => $request->get('billing_postcode'),
			'billing_address' => $request->get('billing_address'),
			'shipping_postcode' => $request->get('shipping_postcode'),
			'shipping_address' => $request->get('shipping_address'),
			'bid' => $request->get('bid'),
			'iban' => $request->get('iban'),
			'swift' => $request->get('swift'),
			'email' => $request->get('email'),
			'phone' => $request->get('phone'),
			'order_interval' => (integer)$request->get('order_interval'),
			'comment' => $request->get('comment'),
			'calendar_comment' => $request->get('calendar_comment'),
			'incomterms' => $request->get('incomterms'),
			'terms_of_cooperation' => $request->get('terms_of_cooperation'),
			'terms_of_delivery' => $request->get('terms_of_delivery'),
			'terms_of_equipment' => $request->get('terms_of_equipment'),
			'delivery_payer' => $request->get('delivery_payer'),
			'payment_conditions' => $request->get('payment_conditions'),
			'pays_vat' => (boolean)$request->get('pays_vat'),
			'stock' => (integer)$request->get('stock'),
			'customerType' => (integer)$request->get('customerType'),
			'paymentType' => (integer)$request->get('paymentType'),
			'user' => (integer)$request->get('user'),
			'billingRegion' => (integer)$request->get('billingRegion'),
			'shippingRegion' => (integer)$request->get('shippingRegion'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'name' => $request->get('name'),
			'legal_name' => $request->get('legal_name'),
			'billing_postcode' => $request->get('billing_postcode'),
			'billing_address' => $request->get('billing_address'),
			'shipping_postcode' => $request->get('shipping_postcode'),
			'shipping_address' => $request->get('shipping_address'),
			'bid' => $request->get('bid'),
			'iban' => $request->get('iban'),
			'swift' => $request->get('swift'),
			'email' => $request->get('email'),
			'phone' => $request->get('phone'),
			'order_interval' => (integer)$request->get('order_interval'),
			'comment' => $request->get('comment'),
			'calendar_comment' => $request->get('calendar_comment'),
			'incomterms' => $request->get('incomterms'),
			'terms_of_cooperation' => $request->get('terms_of_cooperation'),
			'terms_of_delivery' => $request->get('terms_of_delivery'),
			'terms_of_equipment' => $request->get('terms_of_equipment'),
			'delivery_payer' => $request->get('delivery_payer'),
			'payment_conditions' => $request->get('payment_conditions'),
			'pays_vat' => (boolean)$request->get('pays_vat'),
			'stock' => (integer)$request->get('stock'),
			'customerType' => (integer)$request->get('customerType'),
			'paymentType' => (integer)$request->get('paymentType'),
			'user' => (integer)$request->get('user'),
			'billingRegion' => (integer)$request->get('billingRegion'),
			'shippingRegion' => (integer)$request->get('shippingRegion'),

		];
	}

	/**
	 * @param Customer $customer
	 * @return array
	 */
	public static function toArray($customer)
	{
		return [
			'id' => (int)$customer->getKey(),
			'name' => $customer->name,
			'legal_name' => $customer->legal_name,
			'billing_postcode' => $customer->billing_postcode,
			'billing_address' => $customer->billing_address,
			'shipping_postcode' => $customer->shipping_postcode,
			'shipping_address' => $customer->shipping_address,
			'bid' => $customer->bid,
			'iban' => $customer->iban,
			'swift' => $customer->swift,
			'email' => $customer->email,
			'phone' => $customer->phone,
			'order_interval' => (integer)$customer->order_interval,
			'comment' => $customer->comment,
			'calendar_comment' => $customer->calendar_comment,
			'incomterms' => $customer->incomterms,
			'terms_of_cooperation' => $customer->terms_of_cooperation,
			'terms_of_delivery' => $customer->terms_of_delivery,
			'terms_of_equipment' => $customer->terms_of_equipment,
			'delivery_payer' => $customer->delivery_payer,
			'payment_conditions' => $customer->payment_conditions,
			'pays_vat' => (boolean)$customer->pays_vat,
			'stock' => $customer->stock ? StockTransformer::toArray($customer->stock) : null,
			'customerType' => $customer->customerType ? CustomerTypeTransformer::toArray($customer->customerType) : null,
			'paymentType' => $customer->paymentType ? PaymentTypeTransformer::toArray($customer->paymentType) : null,
			'user' => $customer->user ? UserTransformer::toArray($customer->user) : null,
			'billingRegion' => $customer->billingRegion ? RegionTransformer::toArray($customer->billingRegion) : null,
			'shippingRegion' => $customer->shippingRegion ? RegionTransformer::toArray($customer->shippingRegion) : null,

			'created_at' => (string)$customer->created_at,
			'updated_at' => (string)$customer->updated_at,
			'deleted_at' => (string)$customer->deleted_at,
		];
	}
}