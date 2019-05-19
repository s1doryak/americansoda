<?php

namespace App\Transformers\App;

use App\Job;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Job transformer.
 *
 * @package App\Transformers\App
 */
class JobTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'queue' => $request->get('queue'),
			'payload' => $request->get('payload'),
			'attempts' => (integer)$request->get('attempts'),
			'reserved_at' => $request->get('reserved_at'),
			'available_at' => $request->get('available_at'),
			'created_at' => $request->get('created_at'),


		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'queue' => $request->get('queue'),
			'payload' => $request->get('payload'),
			'attempts' => (integer)$request->get('attempts'),
			'reserved_at' => $request->get('reserved_at'),
			'available_at' => $request->get('available_at'),
			'created_at' => $request->get('created_at'),


		];
	}

	/**
	 * @param Job $job
	 * @return array
	 */
	public static function toArray($job)
	{
		return [
			'id' => (int)$job->getKey(),
			'queue' => $job->queue,
			'payload' => $job->payload,
			'attempts' => (integer)$job->attempts,
			'reserved_at' => $job->reserved_at,
			'available_at' => $job->available_at,
			'created_at' => $job->created_at,


			'created_at' => (string)$job->created_at,
			'updated_at' => (string)$job->updated_at,
			'deleted_at' => (string)$job->deleted_at,
		];
	}
}