<?php

namespace App\Forms\Dashboard;

use App\Company;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Company form.
 *
 * @package App\Forms\Dashboard
 */
class CompanyForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'name' => 'text',
            'legal_name' => 'text',
            'short_name' => 'text',
            'postcode' => 'text',
            'address' => 'text',
            'bid' => 'text',
            'email' => 'text',
            'phone' => 'text',
            'code' => 'text',
            'smtp_host' => 'text',
            'smtp_port' => 'text',
            'smtp_encryption' => 'text',
            'smtp_username' => 'text',
            'smtp_password' => 'text',
            'smtp_from' => 'text',
            'smtp_from_name' => 'text',
            'region' => 'choice',
        ];
    }

    /**
     * @param Company $company
     * @return array
     */
    public static function getEditFormFields($company)
    {
        return [
            'name' => 'text',
            'legal_name' => 'text',
            'short_name' => 'text',
            'postcode' => 'text',
            'address' => 'text',
            'bid' => 'text',
            'email' => 'text',
            'phone' => 'text',
            'code' => 'text',
            'smtp_host' => 'text',
            'smtp_port' => 'text',
            'smtp_encryption' => 'text',
            'smtp_username' => 'text',
            'smtp_password' => 'text',
            'smtp_from' => 'text',
            'smtp_from_name' => 'text',
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
            'legal_name' => 'sometimes',
            'short_name' => 'sometimes',
            'postcode' => 'sometimes',
            'address' => 'sometimes',
            'bid' => 'sometimes',
            'email' => 'sometimes',
            'phone' => 'sometimes',
            'code' => 'sometimes',
            'smtp_host' => 'sometimes',
            'smtp_port' => 'sometimes',
            'smtp_encryption' => 'sometimes',
            'smtp_username' => 'sometimes',
            'smtp_password' => 'sometimes',
            'smtp_from' => 'sometimes',
            'smtp_from_name' => 'sometimes',
            'region' => 'sometimes|exists:regions,id',
        ];
    }

    /**
     * @param Company $company
     * @return array
     */
    public static function getUpdateValidationRules($company)
    {
        return [
            'name' => 'sometimes',
            'legal_name' => 'sometimes',
            'short_name' => 'sometimes',
            'postcode' => 'sometimes',
            'address' => 'sometimes',
            'bid' => 'sometimes',
            'email' => 'sometimes',
            'phone' => 'sometimes',
            'code' => 'sometimes',
            'smtp_host' => 'sometimes',
            'smtp_port' => 'sometimes',
            'smtp_encryption' => 'sometimes',
            'smtp_username' => 'sometimes',
            'smtp_password' => 'sometimes',
            'smtp_from' => 'sometimes',
            'smtp_from_name' => 'sometimes',
            'region' => 'sometimes|exists:regions,id',
        ];
    }
}
