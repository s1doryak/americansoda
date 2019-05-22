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
				'product_name' => 'text',
				'products_quantity' => 'number',
				'delivery_number' => 'text',
				'expiration_date' => 'timepicker',
				'movement_type' => 'text',
				'comment' => 'textarea',
				'stockMovement' => 'choice',
				'product' => 'choice',
        ];
	}

    /**
     * @param StockMovementProduct $stockMovementProduct
     * @return array
     */
	public static function getEditFormFields($stockMovementProduct)
	{
        return [
				'product_name' => 'text',
				'products_quantity' => 'number',
				'delivery_number' => 'text',
				'expiration_date' => 'timepicker',
				'movement_type' => 'text',
				'comment' => 'textarea',
				'stockMovement' => 'choice',
				'product' => 'choice',
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