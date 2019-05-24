<?php

namespace App\Transformers\Dashboard;

use App\ProductTag;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * ProductTag transformer.
 *
 * @package App\Transformers\Dashboard
 */
class ProductTagTransformer implements TransformerContract
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
			'icon' => $request->get('icon'),
			'color' => $request->get('color'),


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
			'icon' => $request->get('icon'),
			'color' => $request->get('color'),


		];
	}

	/**
	 * @param ProductTag $productTag
	 * @return array
	 */
	public static function toArray($productTag)
	{
		return [
			'id' => (int)$productTag->getKey(),
			'name' => $productTag->name,
			'icon' => $productTag->icon,
			'color' => $productTag->color,


			'created_at' => (string)$productTag->created_at,
			'updated_at' => (string)$productTag->updated_at,
			'deleted_at' => (string)$productTag->deleted_at,
		];
	}
}