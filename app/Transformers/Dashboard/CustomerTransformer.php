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
            'ltp_number' => (integer)$request->get('ltp_number'),
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
            'ltp_number' => (integer)$request->get('ltp_number'),
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
            'y_tunnus' => $customer->y_tunnus,
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
            'ltp_number' => $customer->ltp_number,
            'stock' => $customer->stock ? StockTransformer::toArray($customer->stock) : null,
            'customerType' => $customer->customerType ? CustomerTypeTransformer::toArray($customer->customerType) : null,
            'paymentType' => $customer->paymentType ? PaymentTypeTransformer::toArray($customer->paymentType) : null,
            'user' => $customer->user ? UserTransformer::toArray($customer->user) : null,
            'billingRegion' => $customer->billingRegion ? RegionTransformer::toArray($customer->billingRegion) : null,
            'shippingRegion' => $customer->shippingRegion ? RegionTransformer::toArray($customer->shippingRegion) : null,

            'created_at' => (string)$customer->created_at,
            'updated_at' => (string)$customer->updated_at,
            'deleted_at' => (string)$customer->deleted_at,
            'nr' => $customer->nr,
            'country' => $customer->country,
            'state' => $customer->state,
            'post_code' => $customer->post_code,
            'post_office' => $customer->post_office,
            'address1' => $customer->address1,
            'address2' => $customer->address2,
            'contact_p' => $customer->contact_p,
            'bid' => $customer->bid,
            'ovt' => $customer->ovt,
            'priceGroup' => $customer->priceGroup ? PriceGroupTransformer::toArray($customer->priceGroup) : null,
            'zendesk_id' => $customer->zendesk_id,
        ];
    }

    /**
     * @param Customer $customer
     * @return object
     */
    public static function toMaventa($customer)
    {
        /**
         * # Gather needed data for invoice customer
         * $customer = array();
         * $customer['customer_nr'] = '1001';
         * $customer['name'] = 'Test Customer';
         * $customer['email'] = 'test.customer@maventa.com';
         * $customer['bid'] = 'FI12345678';
         * $customer['address1'] = 'Customer address';
         * $customer['address2'] = '';
         * $customer['post_code'] = '00100';
         * $customer['post_office'] = 'Helsinki';
         * $customer['country'] = 'FI';
         * $customer['contact_p'] = 'Customer Test';
         * $customer['lang'] = 'FI';
         * $customer['customer_type'] = 'COMPANY';
         * $customer['state'] = null;
         * $customer['phone'] = null;
         * $customer['gsm'] = null;
         * $customer['ovt'] = null;
         */

        return (object)[
            'customer_type' => 'COMPANY',
            'customer_nr' => $customer->nr,

            'name' => $customer->legal_name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'gsm' => null,


            'lang' => 'FI',
            'country' => 'FI',
            'state' => $customer->state,
            'post_code' => $customer->post_code,
            'post_office' => $customer->post_office,
            'address1' => $customer->address1,
            'address2' => $customer->address2,

            'contact_p' => $customer->name,

            'bid' => $customer->bid,
            'ovt' => $customer->ovt,
        ];
    }
}
