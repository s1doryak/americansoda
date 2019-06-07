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
			'quantity' => 'text',
			'products_quantity' => 'text',
			'price' => 'text',
			'vat_price' => 'text',
			'total_price' => 'text',
			'total_vat_price' => 'text',
			'deposit_price' => 'text',
			'deposit_vat_price' => 'text',
			'total_deposit_price' => 'text',
			'total_deposit_vat_price' => 'text',
			'customerPreOrder' => 'choice',
			'customerUser' => 'choice',
			'customer' => 'choice',
			'product' => 'choice',
        ];
	}

    /**
     * @param CustomerPreOrderItem $customerPreOrderItem
     * @return array
     */
	public static function getEditFormFields($customerPreOrderItem)
	{
        return [
			'quantity' => 'text',
			'products_quantity' => 'text',
			'price' => 'text',
			'vat_price' => 'text',
			'total_price' => 'text',
			'total_vat_price' => 'text',
			'deposit_price' => 'text',
			'deposit_vat_price' => 'text',
			'total_deposit_price' => 'text',
			'total_deposit_vat_price' => 'text',
			'customerPreOrder' => 'choice',
			'customerUser' => 'choice',
			'customer' => 'choice',
			'product' => 'choice',
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
			'deposit_price' => 'sometimes',
			'deposit_vat_price' => 'sometimes',
			'total_deposit_price' => 'sometimes',
			'total_deposit_vat_price' => 'sometimes',
			'customerPreOrder' => 'sometimes|exists:customer_pre_orders,id',
			'customerUser' => 'sometimes|exists:customer_users,id',
			'customer' => 'sometimes|exists:customers,id',
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
			'deposit_price' => 'sometimes',
			'deposit_vat_price' => 'sometimes',
			'total_deposit_price' => 'sometimes',
			'total_deposit_vat_price' => 'sometimes',
			'customerPreOrder' => 'sometimes|exists:customer_pre_orders,id',
			'customerUser' => 'sometimes|exists:customer_users,id',
			'customer' => 'sometimes|exists:customers,id',
			'product' => 'sometimes|exists:products,id',
        ];
	}
}