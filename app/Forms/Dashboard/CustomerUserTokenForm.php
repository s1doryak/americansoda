<?php

namespace App\Forms\Dashboard;

use App\CustomerUserToken;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerUserToken form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerUserTokenForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'token' => 'text',
			'ip_address' => 'text',
			'user_agent' => 'text',
			'customerUser' => 'choice',
        ];
	}

    /**
     * @param CustomerUserToken $customerUserToken
     * @return array
     */
	public static function getEditFormFields($customerUserToken)
	{
        return [
			'token' => 'text',
			'ip_address' => 'text',
			'user_agent' => 'text',
			'customerUser' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'token' => 'sometimes',
			'ip_address' => 'sometimes',
			'user_agent' => 'sometimes',
			'customerUser' => 'sometimes|exists:customer_users,id',
        ];
	}

    /**
     * @param CustomerUserToken $customerUserToken
     * @return array
     */
	public static function getUpdateValidationRules($customerUserToken)
	{
        return [
			'token' => 'sometimes',
			'ip_address' => 'sometimes',
			'user_agent' => 'sometimes',
			'customerUser' => 'sometimes|exists:customer_users,id',
        ];
	}
}