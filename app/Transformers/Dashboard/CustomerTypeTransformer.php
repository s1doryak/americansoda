<?php

namespace App\Transformers\Dashboard;

use App\CustomerType;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerType transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerTypeTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'name' => $request->get('name'),
			'customerType' => (integer)$request->get('customerType'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'name' => $request->get('name'),
			'customerType' => (integer)$request->get('customerType'),

		];
	}

	/**
	 * @param CustomerType $customerType
	 * @return array
	 */
	public static function toArray($customerType)
	{
		return [
			'id' => (int)$customerType->getKey(),
			'name' => $customerType->name,
			'customerType' => $customerType->customerType ? CustomerTypeTransformer::toArray($customerType->customerType) : null,

			'created_at' => (string)$customerType->created_at,
			'updated_at' => (string)$customerType->updated_at,
			'deleted_at' => (string)$customerType->deleted_at,
		];
	}
}