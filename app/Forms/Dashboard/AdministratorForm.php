<?php

namespace App\Forms\Dashboard;

use App\Administrator;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Administrator form.
 *
 * @package App\Forms\Dashboard
 */
class AdministratorForm extends Form
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
     * @param Administrator $administrator
     * @return array
     */
	public static function getEditFormFields($administrator)
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
			'email' => 'sometimes|email|unique:administrators',
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
     * @param Administrator $administrator
     * @return array
     */
	public static function getUpdateValidationRules($administrator)
	{
        return [
			'email' => [
				'required',
				'email',
				Rule::unique('administrators')->ignore($administrator->id),
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