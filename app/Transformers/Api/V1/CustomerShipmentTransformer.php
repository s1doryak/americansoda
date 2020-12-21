<?php

namespace App\Transformers\Api\V1;

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
			'customerInvoice' => $customerShipment->customerInvoice()->exists(),

			'created_at' => (string)$customerShipment->created_at,
			'updated_at' => (string)$customerShipment->updated_at,
			'deleted_at' => (string)$customerShipment->deleted_at,
		];
	}
}
