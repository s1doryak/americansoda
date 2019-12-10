<?php

namespace App\Transformers\Dashboard;

use App\ProductType;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * ProductType transformer.
 *
 * @package App\Transformers\Dashboard
 */
class ProductTypeTransformer implements TransformerContract
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
	 * @param ProductType $productType
	 * @return array
	 */
	public static function toArray($productType)
	{
		return [
			'id' => (int)$productType->getKey(),
			'name' => $productType->name,


			'created_at' => (string)$productType->created_at,
			'updated_at' => (string)$productType->updated_at,
			'deleted_at' => (string)$productType->deleted_at,
		];
	}
}