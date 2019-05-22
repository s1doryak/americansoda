<?php

namespace App\Transformers\Dashboard;

use App\PaymentType;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * PaymentType transformer.
 *
 * @package App\Transformers\Dashboard
 */
class PaymentTypeTransformer implements TransformerContract
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


		];
	}

	/**
	 * @param PaymentType $paymentType
	 * @return array
	 */
	public static function toArray($paymentType)
	{
		return [
			'id' => (int)$paymentType->getKey(),
			'name' => $paymentType->name,


			'created_at' => (string)$paymentType->created_at,
			'updated_at' => (string)$paymentType->updated_at,
			'deleted_at' => (string)$paymentType->deleted_at,
		];
	}
}