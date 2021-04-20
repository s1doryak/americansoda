<?php

namespace App\Transformers\Dashboard;

use App\CustomerUserToken;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerUserToken transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerUserTokenTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'token' => $request->get('token'),
			'ip_address' => $request->get('ip_address'),
			'user_agent' => $request->get('user_agent'),
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
			'token' => $request->get('token'),
			'ip_address' => $request->get('ip_address'),
			'user_agent' => $request->get('user_agent'),
			'customerUser' => (integer)$request->get('customerUser'),

		];
	}

	/**
	 * @param CustomerUserToken $customerUserToken
	 * @return array
	 */
	public static function toArray($customerUserToken)
	{
		return [
			'id' => (int)$customerUserToken->getKey(),
			'token' => $customerUserToken->token,
			'ip_address' => $customerUserToken->ip_address,
			'user_agent' => $customerUserToken->user_agent,
			'customerUser' => $customerUserToken->customerUser ? CustomerUserTransformer::toArray($customerUserToken->customerUser) : null,

			'created_at' => (string)$customerUserToken->created_at,
			'updated_at' => (string)$customerUserToken->updated_at,
			'deleted_at' => (string)$customerUserToken->deleted_at,
		];
	}
}