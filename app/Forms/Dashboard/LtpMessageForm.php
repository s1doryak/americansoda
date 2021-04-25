<?php

namespace App\Forms\Dashboard;

use App\LtpMessage;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * LtpMessage form.
 *
 * @package App\Forms\Dashboard
 */
class LtpMessageForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'sender_identifier' => 'text',
			'sender_description' => 'text',
			'filename_hint' => 'text',
			'content' => 'editor',
        ];
	}

    /**
     * @param LtpMessage $ltpMessage
     * @return array
     */
	public static function getEditFormFields($ltpMessage)
	{
        return [
			'sender_identifier' => 'text',
			'sender_description' => 'text',
			'filename_hint' => 'text',
			'content' => 'editor',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'sender_identifier' => 'sometimes',
			'sender_description' => 'sometimes',
			'filename_hint' => 'sometimes',
			'content' => 'sometimes',
        ];
	}

    /**
     * @param LtpMessage $ltpMessage
     * @return array
     */
	public static function getUpdateValidationRules($ltpMessage)
	{
        return [
			'sender_identifier' => 'sometimes',
			'sender_description' => 'sometimes',
			'filename_hint' => 'sometimes',
			'content' => 'sometimes',
        ];
	}
}