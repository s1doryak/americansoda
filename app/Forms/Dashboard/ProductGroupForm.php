<?php

namespace App\Forms\Dashboard;

use App\ProductGroup;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * ProductGroup form.
 *
 * @package App\Forms\Dashboard
 */
class ProductGroupForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'name' => 'text',
				'vat' => 'number',
				'sales_unit_volume' => 'number',
        ];
	}

    /**
     * @param ProductGroup $productGroup
     * @return array
     */
	public static function getEditFormFields($productGroup)
	{
        return [
				'name' => 'text',
				'vat' => 'number',
				'sales_unit_volume' => 'number',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
			'vat' => 'sometimes',
			'sales_unit_volume' => 'sometimes',
        ];
	}

    /**
     * @param ProductGroup $productGroup
     * @return array
     */
	public static function getUpdateValidationRules($productGroup)
	{
        return [
			'name' => 'sometimes',
			'vat' => 'sometimes',
			'sales_unit_volume' => 'sometimes',
        ];
	}
}