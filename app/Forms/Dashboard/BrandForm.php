<?php

namespace App\Forms\Dashboard;

use App\Brand;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Brand form.
 *
 * @package App\Forms\Dashboard
 */
class BrandForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'name' => 'text',
				'logo' => 'image',
        ];
	}

    /**
     * @param Brand $brand
     * @return array
     */
	public static function getEditFormFields($brand)
	{
        return [
				'name' => 'text',
				'logo' => 'image',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
			'logo' => 'sometimes',
        ];
	}

    /**
     * @param Brand $brand
     * @return array
     */
	public static function getUpdateValidationRules($brand)
	{
        return [
			'name' => 'sometimes',
			'logo' => 'sometimes',
        ];
	}
}