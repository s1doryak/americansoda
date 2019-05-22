<?php

namespace App\Forms\Dashboard;

use App\CustomerType;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerType form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerTypeForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'name' => 'text',
				'customerType' => 'choice',
        ];
	}

    /**
     * @param CustomerType $customerType
     * @return array
     */
	public static function getEditFormFields($customerType)
	{
        return [
				'name' => 'text',
				'customerType' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'name' => 'sometimes',
			'customerType' => 'sometimes|exists:customer_types,id',
        ];
	}

    /**
     * @param CustomerType $customerType
     * @return array
     */
	public static function getUpdateValidationRules($customerType)
	{
        return [
			'name' => 'sometimes',
			'customerType' => 'sometimes|exists:customer_types,id',
        ];
	}
}