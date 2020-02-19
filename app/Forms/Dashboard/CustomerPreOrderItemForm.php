<?php

namespace App\Forms\Dashboard;

use App\CustomerPreOrderItem;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerPreOrderItem form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerPreOrderItemForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'product' => [
                'type' => 'choice',
                'empty_value' => trans('models/customer_pre_order_item.placeholders.product'),
                'multiple' => false,
                'attr' => [
                    'data-live-search' => 'true'
                ]
            ],
            'quantity' => 'text',
            'products_quantity' => 'text',
            'price' => 'text',
            'vat_price' => 'text',
            'total_price' => 'text',
            'total_vat_price' => 'text',
        ];
    }

    /**
     * @param CustomerPreOrderItem $customerPreOrderItem
     * @return array
     */
    public static function getEditFormFields($customerPreOrderItem)
    {
        return [
            'product' => [
                'type' => 'choice',
                'empty_value' => trans('models/customer_pre_order_item.placeholders.product'),
                'multiple' => false,
                'attr' => [
                    'data-live-search' => 'true'
                ]
            ],
            'quantity' => 'text',
            'products_quantity' => 'text',
            'price' => 'text',
            'vat_price' => 'text',
            'total_price' => 'text',
            'total_vat_price' => 'text',
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'quantity' => 'sometimes',
            'products_quantity' => 'sometimes',
            'price' => 'sometimes',
            'vat_price' => 'sometimes',
            'total_price' => 'sometimes',
            'total_vat_price' => 'sometimes',
            'product' => 'sometimes|exists:products,id',
        ];
    }

    /**
     * @param CustomerPreOrderItem $customerPreOrderItem
     * @return array
     */
    public static function getUpdateValidationRules($customerPreOrderItem)
    {
        return [
            'quantity' => 'sometimes',
            'products_quantity' => 'sometimes',
            'price' => 'sometimes',
            'vat_price' => 'sometimes',
            'total_price' => 'sometimes',
            'total_vat_price' => 'sometimes',
            'product' => 'sometimes|exists:products,id',
        ];
    }
}