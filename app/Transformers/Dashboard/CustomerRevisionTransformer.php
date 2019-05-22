<?php

namespace App\Transformers\Dashboard;

use App\CustomerRevision;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerRevision transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerRevisionTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'revision_type' => $request->get('revision_type'),
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
			'revision' => (integer)$request->get('revision'),
			'editor' => (integer)$request->get('editor'),
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
			'revision_type' => $request->get('revision_type'),
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
			'revision' => (integer)$request->get('revision'),
			'editor' => (integer)$request->get('editor'),
			'stock' => (integer)$request->get('stock'),
			'customerType' => (integer)$request->get('customerType'),
			'paymentType' => (integer)$request->get('paymentType'),
			'user' => (integer)$request->get('user'),
			'billingRegion' => (integer)$request->get('billingRegion'),
			'shippingRegion' => (integer)$request->get('shippingRegion'),

		];
	}

	/**
	 * @param CustomerRevision $customerRevision
	 * @return array
	 */
	public static function toArray($customerRevision)
	{
		return [
			'id' => (int)$customerRevision->getKey(),
			'revision_type' => $customerRevision->revision_type,
			'name' => $customerRevision->name,
			'legal_name' => $customerRevision->legal_name,
			'billing_postcode' => $customerRevision->billing_postcode,
			'billing_address' => $customerRevision->billing_address,
			'shipping_postcode' => $customerRevision->shipping_postcode,
			'shipping_address' => $customerRevision->shipping_address,
			'bid' => $customerRevision->bid,
			'iban' => $customerRevision->iban,
			'swift' => $customerRevision->swift,
			'email' => $customerRevision->email,
			'phone' => $customerRevision->phone,
			'order_interval' => (integer)$customerRevision->order_interval,
			'comment' => $customerRevision->comment,
			'calendar_comment' => $customerRevision->calendar_comment,
			'incomterms' => $customerRevision->incomterms,
			'terms_of_cooperation' => $customerRevision->terms_of_cooperation,
			'terms_of_delivery' => $customerRevision->terms_of_delivery,
			'terms_of_equipment' => $customerRevision->terms_of_equipment,
			'delivery_payer' => $customerRevision->delivery_payer,
			'payment_conditions' => $customerRevision->payment_conditions,
			'pays_vat' => (boolean)$customerRevision->pays_vat,
			'revision' => $customerRevision->revision ? CustomerRevisionTransformer::toArray($customerRevision->revision) : null,
			'editor' => $customerRevision->editor ? UserTransformer::toArray($customerRevision->editor) : null,
			'stock' => $customerRevision->stock ? StockTransformer::toArray($customerRevision->stock) : null,
			'customerType' => $customerRevision->customerType ? CustomerTypeTransformer::toArray($customerRevision->customerType) : null,
			'paymentType' => $customerRevision->paymentType ? PaymentTypeTransformer::toArray($customerRevision->paymentType) : null,
			'user' => $customerRevision->user ? UserTransformer::toArray($customerRevision->user) : null,
			'billingRegion' => $customerRevision->billingRegion ? RegionTransformer::toArray($customerRevision->billingRegion) : null,
			'shippingRegion' => $customerRevision->shippingRegion ? RegionTransformer::toArray($customerRevision->shippingRegion) : null,

			'created_at' => (string)$customerRevision->created_at,
			'updated_at' => (string)$customerRevision->updated_at,
			'deleted_at' => (string)$customerRevision->deleted_at,
		];
	}
}