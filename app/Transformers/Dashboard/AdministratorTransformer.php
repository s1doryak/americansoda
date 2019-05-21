<?php

namespace App\Transformers\Dashboard;

use App\Administrator;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Administrator transformer.
 *
 * @package App\Transformers\Dashboard
 */
class AdministratorTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'email' => $request->get('email'),
			'name' => $request->get('name'),
			'phone' => $request->get('phone'),
			'avatar' => $request->file('avatar'),
			'role' => (integer)$request->get('role'),
			'company' => (integer)$request->get('company'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'email' => $request->get('email'),
			'name' => $request->get('name'),
			'phone' => $request->get('phone'),
			'avatar' => $request->file('avatar'),
			'role' => (integer)$request->get('role'),
			'company' => (integer)$request->get('company'),

		];
	}

	/**
	 * @param Administrator $administrator
	 * @return array
	 */
	public static function toArray($administrator)
	{
		return [
			'id' => (int)$administrator->getKey(),
			'email' => $administrator->email,
			'name' => $administrator->name,
			'phone' => $administrator->phone,
			'avatar' => (string)$administrator->avatar ? asset((string)$administrator->avatar) : null,
			'role' => $administrator->role ? RoleTransformer::toArray($administrator->role) : null,
			'company' => $administrator->company ? CompanyTransformer::toArray($administrator->company) : null,

			'created_at' => (string)$administrator->created_at,
			'updated_at' => (string)$administrator->updated_at,
			'deleted_at' => (string)$administrator->deleted_at,
		];
	}
}