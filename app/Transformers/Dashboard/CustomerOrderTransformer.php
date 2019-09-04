<?php

namespace App\Transformers\Dashboard;

use App\CustomerOrder;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerOrder transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerOrderTransformer implements TransformerContract
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
			'batch_number' => $request->get('batch_number'),
			'comment' => $request->get('comment'),
			//'fc_overdue' => (integer)$request->get('fc_overdue'),
			//'fc_comment' => $request->get('fc_comment'),
			//'fc_future_comment' => $request->get('fc_future_comment'),
			//'sent_at' => $request->get('sent_at'),
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
			'batch_number' => $request->get('batch_number'),
			'comment' => $request->get('comment'),
			//'fc_overdue' => (integer)$request->get('fc_overdue'),
			//'fc_comment' => $request->get('fc_comment'),
			//'fc_future_comment' => $request->get('fc_future_comment'),
			//'sent_at' => $request->get('sent_at'),
			//'customer' => (integer)$request->get('customer'),
			//'user' => (integer)$request->get('user'),

		];
	}

	/**
	 * @param CustomerOrder $customerOrder
	 * @return array
	 */
	public static function toArray($customerOrder)
	{
		return [
			'id' => (int)$customerOrder->getKey(),
			'number' => $customerOrder->number,
			'batch_number' => $customerOrder->batch_number,
			'comment' => $customerOrder->comment,
			'fc_overdue' => (integer)$customerOrder->fc_overdue,
			'fc_comment' => $customerOrder->fc_comment,
			'fc_future_comment' => $customerOrder->fc_future_comment,
			'sent_at' => $customerOrder->sent_at,
			'customer' => $customerOrder->customer ? CustomerTransformer::toArray($customerOrder->customer) : null,
			'user' => $customerOrder->user ? UserTransformer::toArray($customerOrder->user) : null,

			'created_at' => (string)$customerOrder->created_at,
			'updated_at' => (string)$customerOrder->updated_at,
			'deleted_at' => (string)$customerOrder->deleted_at,
		];
	}
}
