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
	 * @param \App\CustomerUserSubscribe $ltpTransferNotification
	 * @return array
	 */
	public static function toArray($ltpTransferNotification)
	{
		return [
			'id' => (int)$ltpTransferNotification->getKey(),

			'product' => $ltpTransferNotification->product ? ProductTransformer::toArray($ltpTransferNotification->product) : null,
			'customerUser' => $ltpTransferNotification->customerUser ? CustomerUserTransformer::toArray($ltpTransferNotification->customerUser) : null,

			'created_at' => (string)$ltpTransferNotification->created_at,
			'updated_at' => (string)$ltpTransferNotification->updated_at,
			'deleted_at' => (string)$ltpTransferNotification->deleted_at,
		];
	}
}
