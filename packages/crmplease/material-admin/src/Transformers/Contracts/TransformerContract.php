<?php

namespace Crmplease\MaterialAdmin\Transformers\Contracts;

use Crmplease\MaterialAdmin\Database\Eloquent\Model;
use Crmplease\MaterialAdmin\Http\Requests\Request;

interface TransformerContract
{
	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request);

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request);

	/**
	 * @param Model $model
	 */
	public static function toArray($model);
}