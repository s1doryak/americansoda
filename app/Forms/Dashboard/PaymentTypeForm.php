<?php

namespace App\Forms\Dashboard;

use App\PaymentType;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * PaymentType form.
 *
 * @package App\Forms\Dashboard
 */
class PaymentTypeForm extends Form
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
     * @param PaymentType $paymentType
     * @return array
     */
	public static function getEditFormFields($paymentType)
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
     * @param PaymentType $paymentType
     * @return array
     */
	public static function getUpdateValidationRules($paymentType)
	{
        return [
			'name' => 'sometimes',
        ];
	}
}