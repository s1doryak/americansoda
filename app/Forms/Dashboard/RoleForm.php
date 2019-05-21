<?php

namespace App\Forms\Dashboard;

use App\Role;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Role form.
 *
 * @package App\Forms\Dashboard
 */
class RoleForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'name' => 'text',
				'slug' => 'text',
        ];
	}

    /**
     * @param Role $role
     * @return array
     */
	public static function getEditFormFields($role)
	{
        return [
				'name' => 'text',
				'slug' => 'text',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
			'slug' => 'sometimes',
        ];
	}

    /**
     * @param Role $role
     * @return array
     */
	public static function getUpdateValidationRules($role)
	{
        return [
			'name' => 'sometimes',
			'slug' => 'sometimes',
        ];
	}
}