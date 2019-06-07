<?php

namespace App\Transformers\Dashboard;

use App\CustomerPreOrder;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerPreOrder transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerPreOrderTransformer implements TransformerContract
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
			'reference_number' => $request->get('reference_number'),
			'comment' => $request->get('comment'),
			'customerUser' => (integer)$request->get('customerUser'),
			'customerOrder' => (integer)$request->get('customerOrder'),
			'customer' => (integer)$request->get('customer'),

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
			'reference_number' => $request->get('reference_number'),
			'comment' => $request->get('comment'),
			'customerUser' => (integer)$request->get('customerUser'),
			'customerOrder' => (integer)$request->get('customerOrder'),
			'customer' => (integer)$request->get('customer'),

		];
	}

	/**
	 * @param CustomerPreOrder $customerPreOrder
	 * @return array
	 */
	public static function toArray($customerPreOrder)
	{
		return [
			'id' => (int)$customerPreOrder->getKey(),
			'number' => $customerPreOrder->number,
			'reference_number' => $customerPreOrder->reference_number,
			'comment' => $customerPreOrder->comment,
			'customerUser' => $customerPreOrder->customerUser ? CustomerUserTransformer::toArray($customerPreOrder->customerUser) : null,
			'customerOrder' => $customerPreOrder->customerOrder ? CustomerOrderTransformer::toArray($customerPreOrder->customerOrder) : null,
			'customer' => $customerPreOrder->customer ? CustomerTransformer::toArray($customerPreOrder->customer) : null,

			'created_at' => (string)$customerPreOrder->created_at,
			'updated_at' => (string)$customerPreOrder->updated_at,
			'deleted_at' => (string)$customerPreOrder->deleted_at,
		];
	}
}