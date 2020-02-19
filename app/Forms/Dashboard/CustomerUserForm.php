<?php

namespace App\Forms\Dashboard;

use App\CustomerUser;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerUser form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerUserForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'email' => 'text',
            'name' => 'text',
            'phone' => 'text',
            'customers' => [
                'type' => 'choice',
                'multiple' => true,
                'empty_value' => trans('models/customer_user.placeholders.customers'),
                'attr' => [
                    'data-live-search' => 'true'
                ],
            ],
            'comment' => 'editor',
        ];
    }

    /**
     * @param CustomerUser $customerUser
     * @return array
     */
    public static function getEditFormFields($customerUser)
    {
        return [
            'email' => 'text',
            'name' => 'text',
            'phone' => 'text',
            'customers' => [
                'type' => 'choice',
                'multiple' => true,
                'attr' => [
                    'data-live-search' => 'true'
                ],
            ],
            'comment' => 'editor',
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'email' => 'sometimes|email|unique:customer_users',
            'name' => 'sometimes',
            'phone' => 'sometimes',
            'customers' => 'sometimes|exists:customers,id',
            'comment' => 'sometimes',
        ];
    }

    /**
     * @param CustomerUser $customerUser
     * @return array
     */
    public static function getUpdateValidationRules($customerUser)
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('customer_users')->ignore($customerUser->getKey()),
            ],
            'name' => 'sometimes',
            'phone' => 'sometimes',
            'customers' => 'sometimes|exists:customers,id',
            'comment' => 'sometimes',
        ];
    }
}
