<?php

namespace App\Transformers\Dashboard;

use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * AuthLog transformer.
 *
 * @package App\Transformers\Dashboard
 */
class AuthLogTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'date' => $request->get('date'),
			'loggable_type' => $request->get('loggable_type'),
			'loggable_id' => (integer)$request->get('loggable_id'),


		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'date' => $request->get('date'),
			'loggable_type' => $request->get('loggable_type'),
			'loggable_id' => (integer)$request->get('loggable_id'),


		];
	}

	/**
	 * @param \App\AuthLog $authLog
	 * @return array
	 */
	public static function toArray($authLog)
	{
		return [
			'id' => (int)$authLog->getKey(),
			'date' => $authLog->date,
			'loggable_type' => $authLog->loggable_type,
			'loggable_id' => (integer)$authLog->loggable_id,


			'created_at' => (string)$authLog->created_at,
			'updated_at' => (string)$authLog->updated_at,
			'deleted_at' => (string)$authLog->deleted_at,
		];
	}
}