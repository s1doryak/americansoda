<?php

namespace App\Transformers\Dashboard;

use App\Role;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Role transformer.
 *
 * @package App\Transformers\Dashboard
 */
class RoleTransformer implements TransformerContract
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
			'slug' => $request->get('slug'),


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
			'slug' => $request->get('slug'),


		];
	}

	/**
	 * @param Role $role
	 * @return array
	 */
	public static function toArray($role)
	{
		return [
			'id' => (int)$role->getKey(),
			'name' => $role->name,
			'slug' => $role->slug,


			'created_at' => (string)$role->created_at,
			'updated_at' => (string)$role->updated_at,
			'deleted_at' => (string)$role->deleted_at,
		];
	}
}