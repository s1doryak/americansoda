<?php

namespace App\Transformers\Dashboard;

use App\Stock;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Stock transformer.
 *
 * @package App\Transformers\Dashboard
 */
class StockTransformer implements TransformerContract
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
			'postcode' => $request->get('postcode'),
			'address' => $request->get('address'),
			'region' => (integer)$request->get('region'),

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
			'postcode' => $request->get('postcode'),
			'address' => $request->get('address'),
			'region' => (integer)$request->get('region'),

		];
	}

	/**
	 * @param Stock $stock
	 * @return array
	 */
	public static function toArray($stock)
	{
		return [
			'id' => (int)$stock->getKey(),
			'name' => $stock->name,
			'postcode' => $stock->postcode,
			'address' => $stock->address,
			'region' => $stock->region ? RegionTransformer::toArray($stock->region) : null,

			'created_at' => (string)$stock->created_at,
			'updated_at' => (string)$stock->updated_at,
			'deleted_at' => (string)$stock->deleted_at,
		];
	}
}