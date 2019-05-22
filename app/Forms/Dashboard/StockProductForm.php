<?php

namespace App\Forms\Dashboard;

use App\StockProduct;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * StockProduct form.
 *
 * @package App\Forms\Dashboard
 */
class StockProductForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'delivery_number' => 'text',
				'expiration_date' => 'timepicker',
				'stock' => 'choice',
				'product' => 'choice',
				'customerOrderItem' => 'choice',
        ];
	}

    /**
     * @param StockProduct $stockProduct
     * @return array
     */
	public static function getEditFormFields($stockProduct)
	{
        return [
				'delivery_number' => 'text',
				'expiration_date' => 'timepicker',
				'stock' => 'choice',
				'product' => 'choice',
				'customerOrderItem' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'delivery_number' => 'sometimes',
			'expiration_date' => 'sometimes',
			'stock' => 'sometimes|exists:stocks,id',
			'product' => 'sometimes|exists:products,id',
			'customerOrderItem' => 'sometimes|exists:customer_order_items,id',
        ];
	}

    /**
     * @param StockProduct $stockProduct
     * @return array
     */
	public static function getUpdateValidationRules($stockProduct)
	{
        return [
			'delivery_number' => 'sometimes',
			'expiration_date' => 'sometimes',
			'stock' => 'sometimes|exists:stocks,id',
			'product' => 'sometimes|exists:products,id',
			'customerOrderItem' => 'sometimes|exists:customer_order_items,id',
        ];
	}
}