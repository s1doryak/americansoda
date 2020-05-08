<?php

namespace App\Forms\Dashboard;

use App\CustomerPricingPolicy;
use Crmplease\MaterialAdmin\Forms\Form;

/**
 * CustomerPricingPolicy form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerPricingPolicyForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'products_range' => [
                'type' => 'text',
            ],
            'price' => [
                'type' => 'text',
            ],
            'id' => [
                'type' => 'hidden',
            ],
            'productGroup' => [
                'type' => 'hidden',
            ],
            '_remove' => [
                'type' => 'hidden',
                'value' => 0,
                'attr' => [
                    'data-remove',
                ],
            ],
            '_changed' => [
                'type' => 'hidden',
                'value' => 0,
                'attr' => [
                    'data-changed',
                ],
            ],
            'submit' => null,
        ];
    }

    /**
     * @param CustomerPricingPolicy $customerPricingPolicy
     * @return array
     */
    public static function getEditFormFields($customerPricingPolicy)
    {
        return [
            'products_range' => 'text',
            'price' => 'text',
            'id' => [
                'type' => 'hidden',
            ],
            'productGroup' => [
                'type' => 'hidden',
            ],
            '_remove' => [
                'type' => 'hidden',
                'value' => 0,
                'attr' => [
                    'data-remove',
                ],
            ],
            '_changed' => [
                'type' => 'hidden',
                'value' => 0,
                'attr' => [
                    'data-changed',
                ],
            ],
            'submit' => null,
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'products_range' => 'required',
            'price' => 'required',
        ];
    }

    /**
     * @param CustomerPricingPolicy $customerPricingPolicy
     * @return array
     */
    public static function getUpdateValidationRules($customerPricingPolicy)
    {
        return [
            'products_range' => 'required',
            'price' => 'required',
        ];
    }
}
