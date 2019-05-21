<?php

namespace App\Forms\Dashboard;

use App\Region;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Region form.
 *
 * @package App\Forms\Dashboard
 */
class RegionForm extends Form
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
     * @param Region $region
     * @return array
     */
	public static function getEditFormFields($region)
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
     * @param Region $region
     * @return array
     */
	public static function getUpdateValidationRules($region)
	{
        return [
			'name' => 'sometimes',
        ];
	}
}