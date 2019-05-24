<?php

namespace App\Forms\Dashboard;

use App\ProductTag;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * ProductTag form.
 *
 * @package App\Forms\Dashboard
 */
class ProductTagForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'name' => 'text',
				'icon' => 'text',
				'color' => 'colorpicker',
        ];
	}

    /**
     * @param ProductTag $productTag
     * @return array
     */
	public static function getEditFormFields($productTag)
	{
        return [
				'name' => 'text',
				'icon' => 'text',
				'color' => 'colorpicker',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
			'icon' => 'sometimes',
			'color' => 'sometimes',
        ];
	}

    /**
     * @param ProductTag $productTag
     * @return array
     */
	public static function getUpdateValidationRules($productTag)
	{
        return [
			'name' => 'sometimes',
			'icon' => 'sometimes',
			'color' => 'sometimes',
        ];
	}
}