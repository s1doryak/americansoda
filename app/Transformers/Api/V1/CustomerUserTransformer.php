<?php

namespace App\Transformers\Api\V1;

use App\CustomerUser;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerUser transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerUserTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'email' => $request->get('email'),
			'name' => $request->get('name'),
			'phone' => $request->get('phone'),
			'comment' => $request->get('comment'),

			'customers' => (array)$request->get('customers'),
		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'email' => $request->get('email'),
			'name' => $request->get('name'),
			'phone' => $request->get('phone'),
			'comment' => $request->get('comment'),

			'customers' => (array)$request->get('customers'),
		];
	}

	/**
	 * @param CustomerUser $ltpTransfer
	 * @return array
	 */
	public static function toArray($ltpTransfer)
	{
		return [
			'id' => (int)$ltpTransfer->getKey(),
			'email' => $ltpTransfer->email,
			'name' => $ltpTransfer->name,
			'phone' => $ltpTransfer->phone,
            'customers' => $ltpTransfer->customers ? CustomerTransformer::map($ltpTransfer->customers) : [],
            'customer_user_subscribes_count' => $ltpTransfer->customerUserSubscribes()->whereNull('deleted_at')->count(),

            'created_at' => (string)$ltpTransfer->created_at,
			'updated_at' => (string)$ltpTransfer->updated_at,
			'deleted_at' => (string)$ltpTransfer->deleted_at,
		];
	}
}
