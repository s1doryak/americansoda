<?php

namespace App\Transformers\Dashboard;

use App\User;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * User transformer.
 *
 * @package App\Transformers\Dashboard
 */
class UserTransformer implements TransformerContract
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
	 * @param User $user
	 * @return array
	 */
	public static function toArray($user)
	{
		return [
			'id' => (int)$user->getKey(),
			'email' => $user->email,
			'name' => $user->name,
			'phone' => $user->phone,
			'avatar' => (string)$user->avatar ? asset((string)$user->avatar) : null,
			'role' => $user->role ? RoleTransformer::toArray($user->role) : null,
			'company' => $user->company ? CompanyTransformer::toArray($user->company) : null,

			'created_at' => (string)$user->created_at,
			'updated_at' => (string)$user->updated_at,
			'deleted_at' => (string)$user->deleted_at,
		];
	}
}