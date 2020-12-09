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
			'user_agent' => $request->get('user_agent'),
			'zendesk' => $request->get('zendesk'),
			'version' => $request->get('version'),
			'sentry' => $request->get('sentry'),


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
			'user_agent' => $request->get('user_agent'),
			'zendesk' => $request->get('zendesk'),
			'version' => $request->get('version'),
			'sentry' => $request->get('sentry'),


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
			'user_agent' => $authLog->user_agent,
			'zendesk' => $authLog->zendesk,
			'version' => $authLog->version,
			'sentry' => $authLog->sentry,
		];
	}
}