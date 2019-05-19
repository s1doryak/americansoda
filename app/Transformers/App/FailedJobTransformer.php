<?php

namespace App\Transformers\App;

use App\FailedJob;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * FailedJob transformer.
 *
 * @package App\Transformers\App
 */
class FailedJobTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'connection' => $request->get('connection'),
			'queue' => $request->get('queue'),
			'payload' => $request->get('payload'),
			'exception' => $request->get('exception'),
			'failed_at' => $request->get('failed_at'),


		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'connection' => $request->get('connection'),
			'queue' => $request->get('queue'),
			'payload' => $request->get('payload'),
			'exception' => $request->get('exception'),
			'failed_at' => $request->get('failed_at'),


		];
	}

	/**
	 * @param FailedJob $failedJob
	 * @return array
	 */
	public static function toArray($failedJob)
	{
		return [
			'id' => (int)$failedJob->getKey(),
			'connection' => $failedJob->connection,
			'queue' => $failedJob->queue,
			'payload' => $failedJob->payload,
			'exception' => $failedJob->exception,
			'failed_at' => $failedJob->failed_at,


			'created_at' => (string)$failedJob->created_at,
			'updated_at' => (string)$failedJob->updated_at,
			'deleted_at' => (string)$failedJob->deleted_at,
		];
	}
}