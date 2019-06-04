<?php

namespace App\Forms\Dashboard;

use App\PriceGroup;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * PriceGroup form.
 *
 * @package App\Forms\Dashboard
 */
class PriceGroupForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'name' => 'text',
			'manual' => 'checkbox',
        ];
	}

    /**
     * @param PriceGroup $priceGroup
     * @return array
     */
	public static function getEditFormFields($priceGroup)
	{
        return [
			'name' => 'text',
			'manual' => 'checkbox',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
			'manual' => 'sometimes',
        ];
	}

    /**
     * @param PriceGroup $priceGroup
     * @return array
     */
	public static function getUpdateValidationRules($priceGroup)
	{
        return [
			'name' => 'sometimes',
			'manual' => 'sometimes',
        ];
	}
}