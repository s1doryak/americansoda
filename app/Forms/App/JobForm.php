<?php

namespace App\Forms\App;

use App\Job;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Job form.
 *
 * @package App\Forms\App
 */
class JobForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'queue' => 'text',
				'payload' => 'textarea',
				'attempts' => 'number',
				'reserved_at' => 'timepicker',
				'available_at' => 'timepicker',
				'created_at' => 'timepicker',
        ];
	}

    /**
     * @param Job $job
     * @return array
     */
	public static function getEditFormFields($job)
	{
        return [
				'queue' => 'text',
				'payload' => 'textarea',
				'attempts' => 'number',
				'reserved_at' => 'timepicker',
				'available_at' => 'timepicker',
				'created_at' => 'timepicker',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'queue' => 'sometimes',
			'payload' => 'sometimes',
			'attempts' => 'sometimes',
			'reserved_at' => 'sometimes',
			'available_at' => 'sometimes',
			'created_at' => 'sometimes',
        ];
	}

    /**
     * @param Job $job
     * @return array
     */
	public static function getUpdateValidationRules($job)
	{
        return [
			'queue' => 'sometimes',
			'payload' => 'sometimes',
			'attempts' => 'sometimes',
			'reserved_at' => 'sometimes',
			'available_at' => 'sometimes',
			'created_at' => 'sometimes',
        ];
	}
}