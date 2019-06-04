<?php

namespace App\Transformers\Dashboard;

use App\PriceGroup;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * PriceGroup transformer.
 *
 * @package App\Transformers\Dashboard
 */
class PriceGroupTransformer implements TransformerContract
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
			'manual' => (boolean)$request->get('manual'),


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
			'manual' => (boolean)$request->get('manual'),


		];
	}

	/**
	 * @param PriceGroup $priceGroup
	 * @return array
	 */
	public static function toArray($priceGroup)
	{
		return [
			'id' => (int)$priceGroup->getKey(),
			'name' => $priceGroup->name,
			'manual' => (boolean)$priceGroup->manual,


			'created_at' => (string)$priceGroup->created_at,
			'updated_at' => (string)$priceGroup->updated_at,
			'deleted_at' => (string)$priceGroup->deleted_at,
		];
	}
}