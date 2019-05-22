<?php

namespace App\Transformers\Dashboard;

use App\Assembly;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Assembly transformer.
 *
 * @package App\Transformers\Dashboard
 */
class AssemblyTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'number' => $request->get('number'),
			'comment' => $request->get('comment'),


		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'number' => $request->get('number'),
			'comment' => $request->get('comment'),


		];
	}

	/**
	 * @param Assembly $assembly
	 * @return array
	 */
	public static function toArray($assembly)
	{
		return [
			'id' => (int)$assembly->getKey(),
			'number' => $assembly->number,
			'comment' => $assembly->comment,


			'created_at' => (string)$assembly->created_at,
			'updated_at' => (string)$assembly->updated_at,
			'deleted_at' => (string)$assembly->deleted_at,
		];
	}
}