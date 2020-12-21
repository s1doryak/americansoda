<?php

namespace App\Transformers\Api\V1;

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
            'y_tunnus' => $request->get('y_tunnus'),
            'iban' => $request->get('iban'),
            'swift' => $request->get('swift'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'order_interval' => (integer)$request->get('order_interval'),
            'comment' => $request->get('comment'),
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
            'nr' => $request->get('nr'),
            'country' => $request->get('country'),
            'state' => $request->get('state'),
            'post_code' => $request->get('post_code'),
            'post_office' => $request->get('post_office'),
            'address1' => $request->get('address1'),
            'address2' => $request->get('address2'),
            'contact_p' => $request->get('contact_p'),
            'bid' => $request->get('bid'),
            'ovt' => $request->get('ovt'),
            'priceGroup' => (integer)$request->get('priceGroup'),
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
            'y_tunnus' => $request->get('y_tunnus'),
            'iban' => $request->get('iban'),
            'swift' => $request->get('swift'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'order_interval' => (integer)$request->get('order_interval'),
            'comment' => $request->get('comment'),
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
            'nr' => $request->get('nr'),
            'country' => $request->get('country'),
            'state' => $request->get('state'),
            'post_code' => $request->get('post_code'),
            'post_office' => $request->get('post_office'),
            'address1' => $request->get('address1'),
            'address2' => $request->get('address2'),
            'contact_p' => $request->get('contact_p'),
            'bid' => $request->get('bid'),
            'ovt' => $request->get('ovt'),
            'priceGroup' => (integer)$request->get('priceGroup'),
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
            'shipping_address' => $customer->shipping_address,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'user' => $customer->user ? UserTransformer::toArray($customer->user) : null,

            'created_at' => (string)$customer->created_at,
            'updated_at' => (string)$customer->updated_at,
            'deleted_at' => (string)$customer->deleted_at,
        ];
    }
}
