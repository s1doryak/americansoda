<?php

namespace App\Forms\Dashboard;

use App\StockMovementProduct;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * StockMovementProduct form.
 *
 * @package App\Forms\Dashboard
 */
class StockMovementProductForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'product' => [
                'type' => 'choice',
                'multiple' => false,
                'empty_value' => trans('models/stock_movement_product.placeholders.product'),
                'attr' => [
                    'data-live-search' => 'true'
                ]
            ],
            'products_quantity' => 'text',
            'delivery_number' => 'text',
            'expiration_date' => 'datepicker',
            'movement_type' => [
                'type' => 'select',
                'expanded' => true,
                'multiple' => false,
                'choices' => config('stock.movement')
            ],
            'comment' => 'text',
            'submit' => null,
        ];
    }

    /**
     * @param StockMovementProduct $stockMovementProduct
     * @return array
     */
    public static function getEditFormFields($stockMovementProduct)
    {
        return [
            'product' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'products_quantity' => 'text',
            'delivery_number' => 'text',
            'expiration_date' => 'datepicker',
            'movement_type' => [
                'type' => 'select',
                'expanded' => true,
                'multiple' => false,
                'choices' => config('stock.movement')
            ],
            'comment' => 'text',
            'submit' => null,
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'product_name' => 'sometimes',
            'products_quantity' => 'sometimes',
            'delivery_number' => 'sometimes',
            'expiration_date' => 'sometimes',
            'movement_type' => 'sometimes',
            'comment' => 'sometimes',
            'stockMovement' => 'sometimes|exists:stock_movements,id',
            'product' => 'sometimes|exists:products,id',
        ];
    }

    /**
     * @param StockMovementProduct $stockMovementProduct
     * @return array
     */
    public static function getUpdateValidationRules($stockMovementProduct)
    {
        return [
            'product_name' => 'sometimes',
            'products_quantity' => 'sometimes',
            'delivery_number' => 'sometimes',
            'expiration_date' => 'sometimes',
            'movement_type' => 'sometimes',
            'comment' => 'sometimes',
            'stockMovement' => 'sometimes|exists:stock_movements,id',
            'product' => 'sometimes|exists:products,id',
        ];
    }
}