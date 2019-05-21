<?php

namespace App\Transformers\Dashboard;

use App\Region;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Region transformer.
 *
 * @package App\Transformers\Dashboard
 */
class RegionTransformer implements TransformerContract
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
	 * @param Region $region
	 * @return array
	 */
	public static function toArray($region)
	{
		return [
			'id' => (int)$region->getKey(),
			'name' => $region->name,


			'created_at' => (string)$region->created_at,
			'updated_at' => (string)$region->updated_at,
			'deleted_at' => (string)$region->deleted_at,
		];
	}
}