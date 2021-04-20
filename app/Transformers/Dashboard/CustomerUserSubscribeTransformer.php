<?php

namespace App\Transformers\Dashboard;

use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerUserSubscribe transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerUserSubscribeTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [

			'product' => (integer)$request->get('product'),
			'customerUser' => (integer)$request->get('customerUser'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [

			'product' => (integer)$request->get('product'),
			'customerUser' => (integer)$request->get('customerUser'),

		];
	}

	/**
	 * @param \App\CustomerUserSubscribe $customerUserNotification
	 * @return array
	 */
	public static function toArray($customerUserNotification)
	{
		return [
			'id' => (int)$customerUserNotification->getKey(),

			'product' => $customerUserNotification->product ? ProductTransformer::toArray($customerUserNotification->product) : null,
			'customerUser' => $customerUserNotification->customerUser ? CustomerUserTransformer::toArray($customerUserNotification->customerUser) : null,

			'created_at' => (string)$customerUserNotification->created_at,
			'updated_at' => (string)$customerUserNotification->updated_at,
			'deleted_at' => (string)$customerUserNotification->deleted_at,
		];
	}
}
