<?php

namespace App\Transformers\Dashboard;

use App\CustomerPreOrderItem;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerPreOrderItem transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerPreOrderItemTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'quantity' => $request->get('quantity'),
			'products_quantity' => $request->get('products_quantity'),
			'price' => $request->get('price'),
			'vat_price' => $request->get('vat_price'),
			'total_price' => $request->get('total_price'),
			'total_vat_price' => $request->get('total_vat_price'),
			'deposit_price' => $request->get('deposit_price'),
			'deposit_vat_price' => $request->get('deposit_vat_price'),
			'total_deposit_price' => $request->get('total_deposit_price'),
			'total_deposit_vat_price' => $request->get('total_deposit_vat_price'),
			'customerPreOrder' => (integer)$request->get('customerPreOrder'),
			'customerUser' => (integer)$request->get('customerUser'),
			'customer' => (integer)$request->get('customer'),
			'product' => (integer)$request->get('product'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'quantity' => $request->get('quantity'),
			'products_quantity' => $request->get('products_quantity'),
			'price' => $request->get('price'),
			'vat_price' => $request->get('vat_price'),
			'total_price' => $request->get('total_price'),
			'total_vat_price' => $request->get('total_vat_price'),
			'deposit_price' => $request->get('deposit_price'),
			'deposit_vat_price' => $request->get('deposit_vat_price'),
			'total_deposit_price' => $request->get('total_deposit_price'),
			'total_deposit_vat_price' => $request->get('total_deposit_vat_price'),
			'customerPreOrder' => (integer)$request->get('customerPreOrder'),
			'customerUser' => (integer)$request->get('customerUser'),
			'customer' => (integer)$request->get('customer'),
			'product' => (integer)$request->get('product'),

		];
	}

	/**
	 * @param CustomerPreOrderItem $customerPreOrderItem
	 * @return array
	 */
	public static function toArray($customerPreOrderItem)
	{
		return [
			'id' => (int)$customerPreOrderItem->getKey(),
			'quantity' => $customerPreOrderItem->quantity,
			'products_quantity' => $customerPreOrderItem->products_quantity,
			'price' => $customerPreOrderItem->price,
			'vat_price' => $customerPreOrderItem->vat_price,
			'total_price' => $customerPreOrderItem->total_price,
			'total_vat_price' => $customerPreOrderItem->total_vat_price,
			'deposit_price' => $customerPreOrderItem->deposit_price,
			'deposit_vat_price' => $customerPreOrderItem->deposit_vat_price,
			'total_deposit_price' => $customerPreOrderItem->total_deposit_price,
			'total_deposit_vat_price' => $customerPreOrderItem->total_deposit_vat_price,
			'customerPreOrder' => $customerPreOrderItem->customerPreOrder ? CustomerPreOrderTransformer::toArray($customerPreOrderItem->customerPreOrder) : null,
			'customerUser' => $customerPreOrderItem->customerUser ? CustomerUserTransformer::toArray($customerPreOrderItem->customerUser) : null,
			'customer' => $customerPreOrderItem->customer ? CustomerTransformer::toArray($customerPreOrderItem->customer) : null,
			'product' => $customerPreOrderItem->product ? ProductTransformer::toArray($customerPreOrderItem->product) : null,

			'created_at' => (string)$customerPreOrderItem->created_at,
			'updated_at' => (string)$customerPreOrderItem->updated_at,
			'deleted_at' => (string)$customerPreOrderItem->deleted_at,
		];
	}
}