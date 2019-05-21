<?php

namespace App\Transformers\Dashboard;

use App\Brand;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Brand transformer.
 *
 * @package App\Transformers\Dashboard
 */
class BrandTransformer implements TransformerContract
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
			'logo' => $request->file('logo'),


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
			'logo' => $request->file('logo'),


		];
	}

	/**
	 * @param Brand $brand
	 * @return array
	 */
	public static function toArray($brand)
	{
		return [
			'id' => (int)$brand->getKey(),
			'name' => $brand->name,
			'logo' => (string)$brand->logo ? asset((string)$brand->logo) : null,


			'created_at' => (string)$brand->created_at,
			'updated_at' => (string)$brand->updated_at,
			'deleted_at' => (string)$brand->deleted_at,
		];
	}
}