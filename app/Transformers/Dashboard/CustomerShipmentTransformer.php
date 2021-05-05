<?php

namespace App\Transformers\Dashboard;

use App\CustomerShipment;
use App\Repositories\Contracts\LtpTransferRepository;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;
use Illuminate\Support\Arr;

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
        $documentDate = Carbon::createFromFormat('Ymd', preg_replace('/[^0-9,.]+/', '', $customerShipment->assembly_number));

        return [
            'document_type' => 'SO',
            'document_number' => app(LtpTransferRepository::class)->getFirstAvailableNumber(),
            'document_date' => $documentDate,
            'requested_delivery_date' => $customerShipment->delivery_date,
            'owner_reference' => $customerShipment->number,
            'invoicing_reference' => $customerShipment->order_batch_numbers,
            'order_numbers' => $customerShipment->order_numbers,
            'document_party_type' => 'Delivery',
            'code' => $customer->ltp_number ?: $customer->nr,
            'name' => $customer->name,
            'address' => $customer->shipping_address,
            'zip' => $customer->shipping_postcode,
            'city' => $customer->shippingRegion->name,
            'region' => $customer->shippingRegion->name,
            'country' => $customer->country,
            'phone' => $customer->phone,
            'email' => $customer->email,
            'customer_shipment_id' => $customerShipment->getKey(),
            'comment' => $customerShipment->comment,
            'delivery_route' => $customerShipment->number,
        ];
    }
}
