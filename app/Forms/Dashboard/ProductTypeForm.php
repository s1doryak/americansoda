<?php

namespace App\Forms\Dashboard;

use App\ProductType;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * ProductType form.
 *
 * @package App\Forms\Dashboard
 */
class ProductTypeForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'name' => 'text',
        ];
	}

    /**
     * @param ProductType $productType
     * @return array
     */
	public static function getEditFormFields($productType)
	{
        return [
			'name' => 'text',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
        ];
	}

    /**
     * @param ProductType $productType
     * @return array
     */
	public static function getUpdateValidationRules($productType)
	{
        return [
			'name' => 'sometimes',
        ];
	}
}