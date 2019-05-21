<?php

namespace App\Forms\Dashboard;

use App\User;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * User form.
 *
 * @package App\Forms\Dashboard
 */
class UserForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'email' => 'text',
				'email_verified_at' => 'timepicker',
				'password' => 'password',
				'name' => 'text',
				'phone' => 'text',
				'avatar' => 'image',
				'role' => 'choice',
				'company' => 'choice',
        ];
	}

    /**
     * @param User $user
     * @return array
     */
	public static function getEditFormFields($user)
	{
        return [
				'email' => 'text',
				'email_verified_at' => 'timepicker',
				'password' => 'password',
				'name' => 'text',
				'phone' => 'text',
				'avatar' => 'image',
				'role' => 'choice',
				'company' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'email' => 'sometimes|email|unique:users',
			'email_verified_at' => 'sometimes',
			'password' => 'sometimes|string|min:6',
			'name' => 'sometimes',
			'phone' => 'sometimes',
			'avatar' => 'sometimes',
			'role' => 'sometimes|exists:roles,id',
			'company' => 'sometimes|exists:companies,id',
        ];
	}

    /**
     * @param User $user
     * @return array
     */
	public static function getUpdateValidationRules($user)
	{
        return [
			'email' => [
				'required',
				'email',
				Rule::unique('users')->ignore($user->id),
			],
			'email_verified_at' => 'sometimes',
			'password' => 'sometimes|string|min:6',
			'name' => 'sometimes',
			'phone' => 'sometimes',
			'avatar' => 'sometimes',
			'role' => 'sometimes|exists:roles,id',
			'company' => 'sometimes|exists:companies,id',
        ];
	}
}