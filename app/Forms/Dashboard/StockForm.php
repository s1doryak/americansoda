<?php

namespace App\Forms\Dashboard;

use App\Stock;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Stock form.
 *
 * @package App\Forms\Dashboard
 */
class StockForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'name' => 'text',
				'postcode' => 'text',
				'address' => 'text',
				'region' => 'choice',
        ];
	}

    /**
     * @param Stock $stock
     * @return array
     */
	public static function getEditFormFields($stock)
	{
        return [
				'name' => 'text',
				'postcode' => 'text',
				'address' => 'text',
				'region' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
			'postcode' => 'sometimes',
			'address' => 'sometimes',
			'region' => 'sometimes|exists:regions,id',
        ];
	}

    /**
     * @param Stock $stock
     * @return array
     */
	public static function getUpdateValidationRules($stock)
	{
        return [
			'name' => 'sometimes',
			'postcode' => 'sometimes',
			'address' => 'sometimes',
			'region' => 'sometimes|exists:regions,id',
        ];
	}
}