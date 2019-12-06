<?php

namespace App\Transformers\Dashboard;

use App\Banner;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Banner transformer.
 *
 * @package App\Transformers\Dashboard
 */
class BannerTransformer implements TransformerContract
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
			'image' => $request->file('image'),
			'url' => $request->get('url'),

			'customerTypes' => (array)$request->get('customerTypes'),
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
			'image' => $request->file('image'),
			'url' => $request->get('url'),

			'customerTypes' => (array)$request->get('customerTypes'),
		];
	}

	/**
	 * @param Banner $banner
	 * @return array
	 */
	public static function toArray($banner)
	{
		return [
			'id' => (int)$banner->getKey(),
			'name' => $banner->name,
			'image' => (string)$banner->image ? asset((string)$banner->image) : null,
			'url' => $banner->url,

			'customerTypes' => $banner->customerTypes ? CustomerTypeTransformer::map($banner->customerTypes) : [],
			'created_at' => (string)$banner->created_at,
			'updated_at' => (string)$banner->updated_at,
			'deleted_at' => (string)$banner->deleted_at,
		];
	}
}