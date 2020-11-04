<?php

namespace App\Forms\Dashboard;

use App\AuthLog;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * AuthLog form.
 *
 * @package App\Forms\Dashboard
 */
class AuthLogForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'date' => 'datepicker',
			'loggable_type' => 'text',
			'loggable_id' => 'number',
        ];
	}

    /**
     * @param AuthLog $authLog
     * @return array
     */
	public static function getEditFormFields($authLog)
	{
        return [
			'date' => 'datepicker',
			'loggable_type' => 'text',
			'loggable_id' => 'number',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'date' => 'sometimes',
			'loggable_type' => 'sometimes',
			'loggable_id' => 'sometimes',
        ];
	}

    /**
     * @param AuthLog $authLog
     * @return array
     */
	public static function getUpdateValidationRules($authLog)
	{
        return [
			'date' => 'sometimes',
			'loggable_type' => 'sometimes',
			'loggable_id' => 'sometimes',
        ];
	}
}