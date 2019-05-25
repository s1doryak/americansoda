<?php

namespace App\Forms\Dashboard;

use App\FailedJob;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * FailedJob form.
 *
 * @package App\Forms\Dashboard
 */
class FailedJobForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'connection' => 'text',
				'queue' => 'text',
				'payload' => 'textarea',
				'exception' => 'textarea',
				'failed_at' => 'timepicker',
        ];
	}

    /**
     * @param FailedJob $failedJob
     * @return array
     */
	public static function getEditFormFields($failedJob)
	{
        return [
				'connection' => 'text',
				'queue' => 'text',
				'payload' => 'textarea',
				'exception' => 'textarea',
				'failed_at' => 'timepicker',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'connection' => 'sometimes',
			'queue' => 'sometimes',
			'payload' => 'sometimes',
			'exception' => 'sometimes',
			'failed_at' => 'sometimes',
        ];
	}

    /**
     * @param FailedJob $failedJob
     * @return array
     */
	public static function getUpdateValidationRules($failedJob)
	{
        return [
			'connection' => 'sometimes',
			'queue' => 'sometimes',
			'payload' => 'sometimes',
			'exception' => 'sometimes',
			'failed_at' => 'sometimes',
        ];
	}
}
