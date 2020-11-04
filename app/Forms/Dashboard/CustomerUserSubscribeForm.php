<?php

namespace App\Forms\Dashboard;

use App\CustomerUserSubscribe;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerUserSubscribe form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerUserSubscribeForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
            'customerUser' =>  [
                'type' => 'choice',
                'empty_value' => trans('models/customer_user_subscribe.placeholders.customerUser'),
                'attr' => [
                    'data-live-search' => 'true'
                ],
            ],
			'product' =>  [
                'type' => 'choice',
                'empty_value' => trans('models/customer_user_subscribe.placeholders.product'),
                'attr' => [
                    'data-live-search' => 'true'
                ],
            ],
        ];
	}

    /**
     * @param CustomerUserSubscribe $CustomerUserSubscribe
     * @return array
     */
	public static function getEditFormFields($CustomerUserSubscribe)
	{
        return [
            'customerUser' =>  [
                'type' => 'choice',
                'empty_value' => trans('models/customer_user_subscribe.placeholders.customerUser'),
                'attr' => [
                    'data-live-search' => 'true'
                ],
            ],
            'product' =>  [
                'type' => 'choice',
                'empty_value' => trans('models/customer_user_subscribe.placeholders.product'),
                'attr' => [
                    'data-live-search' => 'true'
                ],
            ],
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'product' => 'sometimes|exists:products,id',
			'customerUser' => 'sometimes|exists:customer_users,id',
        ];
	}

    /**
     * @param CustomerUserSubscribe $CustomerUserSubscribe
     * @return array
     */
	public static function getUpdateValidationRules($CustomerUserSubscribe)
	{
        return [
			'product' => 'sometimes|exists:products,id',
			'customerUser' => 'sometimes|exists:customer_users,id',
        ];
	}
}
