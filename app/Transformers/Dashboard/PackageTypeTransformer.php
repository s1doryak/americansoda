<?php

namespace App\Transformers\Dashboard;

use App\PackageType;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * PackageType transformer.
 *
 * @package App\Transformers\Dashboard
 */
class PackageTypeTransformer implements TransformerContract
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
			'description' => $request->get('description'),


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
			'description' => $request->get('description'),


		];
	}

	/**
	 * @param PackageType $packageType
	 * @return array
	 */
	public static function toArray($packageType)
	{
		return [
			'id' => (int)$packageType->getKey(),
			'name' => $packageType->name,
			'description' => $packageType->description,


			'created_at' => (string)$packageType->created_at,
			'updated_at' => (string)$packageType->updated_at,
			'deleted_at' => (string)$packageType->deleted_at,
		];
	}
}