<?php

namespace App\Forms\Dashboard;

use App\PackageType;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * PackageType form.
 *
 * @package App\Forms\Dashboard
 */
class PackageTypeForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'name' => 'text',
				'description' => 'textarea',
        ];
	}

    /**
     * @param PackageType $packageType
     * @return array
     */
	public static function getEditFormFields($packageType)
	{
        return [
				'name' => 'text',
				'description' => 'textarea',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
			'description' => 'sometimes',
        ];
	}

    /**
     * @param PackageType $packageType
     * @return array
     */
	public static function getUpdateValidationRules($packageType)
	{
        return [
			'name' => 'sometimes',
			'description' => 'sometimes',
        ];
	}
}