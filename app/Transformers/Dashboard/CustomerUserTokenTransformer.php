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
	 * @param CustomerUserToken $ltpTransferToken
	 * @return array
	 */
	public static function toArray($ltpTransferToken)
	{
		return [
			'id' => (int)$ltpTransferToken->getKey(),
			'token' => $ltpTransferToken->token,
			'ip_address' => $ltpTransferToken->ip_address,
			'user_agent' => $ltpTransferToken->user_agent,
			'customerUser' => $ltpTransferToken->customerUser ? CustomerUserTransformer::toArray($ltpTransferToken->customerUser) : null,

			'created_at' => (string)$ltpTransferToken->created_at,
			'updated_at' => (string)$ltpTransferToken->updated_at,
			'deleted_at' => (string)$ltpTransferToken->deleted_at,
		];
	}
}
