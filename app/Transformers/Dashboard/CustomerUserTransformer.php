<?php

namespace App\Transformers\Dashboard;

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
	 * @param CustomerUser $customerUser
	 * @return array
	 */
	public static function toArray($customerUser)
	{
		return [
			'id' => (int)$customerUser->getKey(),
			'email' => $customerUser->email,
			'name' => $customerUser->name,
			'phone' => $customerUser->phone,
			'comment' => $customerUser->comment,

			'customers' => $customerUser->customers ? CustomerTransformer::map($customerUser->customers) : [],
			'created_at' => (string)$customerUser->created_at,
			'updated_at' => (string)$customerUser->updated_at,
			'deleted_at' => (string)$customerUser->deleted_at,
		];
	}
}