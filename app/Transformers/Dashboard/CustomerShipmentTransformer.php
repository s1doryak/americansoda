<?php

namespace App\Transformers\Dashboard;

use App\CustomerShipment;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerShipment transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerShipmentTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'number' => $request->get('number'),
			'assembly_number' => $request->get('assembly_number'),
			'invoice_number' => $request->get('invoice_number'),
			'status' => $request->get('status'),
			'delivery_type' => $request->get('delivery_type'),
			'packages_quantity' => (integer)$request->get('packages_quantity'),
			'comment' => $request->get('comment'),
			'packageType' => (integer)$request->get('packageType'),
			'customer' => (integer)$request->get('customer'),
			'user' => (integer)$request->get('user'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'number' => $request->get('number'),
			'assembly_number' => $request->get('assembly_number'),
			'invoice_number' => $request->get('invoice_number'),
			'status' => $request->get('status'),
			'delivery_type' => $request->get('delivery_type'),
			'packages_quantity' => (integer)$request->get('packages_quantity'),
			'comment' => $request->get('comment'),
			'packageType' => (integer)$request->get('packageType'),
			'customer' => (integer)$request->get('customer'),
			'user' => (integer)$request->get('user'),

		];
	}

	/**
	 * @param CustomerShipment $customerShipment
	 * @return array
	 */
	public static function toArray($customerShipment)
	{
		return [
			'id' => (int)$customerShipment->getKey(),
			'number' => $customerShipment->number,
			'assembly_number' => $customerShipment->assembly_number,
			'invoice_number' => $customerShipment->invoice_number,
			'status' => $customerShipment->status,
			'delivery_type' => $customerShipment->delivery_type,
			'packages_quantity' => (integer)$customerShipment->packages_quantity,
			'comment' => $customerShipment->comment,
			'packageType' => $customerShipment->packageType ? PackageTypeTransformer::toArray($customerShipment->packageType) : null,
			'customer' => $customerShipment->customer ? CustomerTransformer::toArray($customerShipment->customer) : null,
			'user' => $customerShipment->user ? UserTransformer::toArray($customerShipment->user) : null,

			'created_at' => (string)$customerShipment->created_at,
			'updated_at' => (string)$customerShipment->updated_at,
			'deleted_at' => (string)$customerShipment->deleted_at,
		];
	}

    /**
     * @param CustomerShipment $customerShipment
     * @return array
     */
	public static function toLtpTransfer(CustomerShipment $customerShipment)
    {
        $customer = $customerShipment->customer;

        return [
            'document_type' => 'SO',
            'document_number' => $customerShipment->order_numbers,
            'requested_delivery_date' => $customerShipment->delivery_date,
            'code' => $customerShipment->order_batch_numbers,
            'name' => $customer->name,
            'address' => $customer->shipping_address,
            'zip' => $customer->shipping_postcode,
            'city' => $customer->shippingRegion->name,
            'waybill' => $customerShipment->getKey(),
        ];
    }
}
