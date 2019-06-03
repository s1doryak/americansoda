<?php

namespace App\Forms\Dashboard;

use App\CompanyBankAccount;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CompanyBankAccount form.
 *
 * @package App\Forms\Dashboard
 */
class CompanyBankAccountForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'bank' => 'text',
			'swift' => 'text',
			'account' => 'text',
			'iban' => 'text',
			'default' => 'checkbox',
			'company' => 'choice',
        ];
	}

    /**
     * @param CompanyBankAccount $companyBankAccount
     * @return array
     */
	public static function getEditFormFields($companyBankAccount)
	{
        return [
			'bank' => 'text',
			'swift' => 'text',
			'account' => 'text',
			'iban' => 'text',
			'default' => 'checkbox',
			'company' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'bank' => 'sometimes',
			'swift' => 'sometimes',
			'account' => 'sometimes',
			'iban' => 'sometimes',
			'default' => 'sometimes',
			'company' => 'sometimes|exists:companies,id',
        ];
	}

    /**
     * @param CompanyBankAccount $companyBankAccount
     * @return array
     */
	public static function getUpdateValidationRules($companyBankAccount)
	{
        return [
			'bank' => 'sometimes',
			'swift' => 'sometimes',
			'account' => 'sometimes',
			'iban' => 'sometimes',
			'default' => 'sometimes',
			'company' => 'sometimes|exists:companies,id',
        ];
	}
}