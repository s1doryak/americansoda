<?php

namespace App\Forms\Dashboard;

use App\CustomerOrderItem;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerOrderItem form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerOrderItemForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'status' => 'text',
				'product_name' => 'text',
				'sales_unit_quantity' => 'text',
				'product_manual_price' => 'checkbox',
				'product_price' => 'text',
				'vat' => 'number',
				'product_vat_price' => 'text',
				'products_quantity' => 'number',
				'packages_quantity' => 'number',
				'total_price' => 'text',
				'total_vat_price' => 'text',
				'deposit_enabled' => 'checkbox',
				'deposit_price' => 'text',
				'deposit_vat' => 'number',
				'deposit_vat_price' => 'text',
				'deposit_total_price' => 'text',
				'deposit_total_vat' => 'text',
				'deposit_total_vat_price' => 'text',
				'bypass' => 'checkbox',
				'back_order' => 'checkbox',
				'cancelled' => 'checkbox',
				'expected_date' => 'timepicker',
				'product' => 'choice',
				'customer' => 'choice',
				'customerOrder' => 'choice',
				'customerShipment' => 'choice',
        ];
	}

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return array
     */
	public static function getEditFormFields($customerOrderItem)
	{
        return [
				'status' => 'text',
				'product_name' => 'text',
				'sales_unit_quantity' => 'text',
				'product_manual_price' => 'checkbox',
				'product_price' => 'text',
				'vat' => 'number',
				'product_vat_price' => 'text',
				'products_quantity' => 'number',
				'packages_quantity' => 'number',
				'total_price' => 'text',
				'total_vat_price' => 'text',
				'deposit_enabled' => 'checkbox',
				'deposit_price' => 'text',
				'deposit_vat' => 'number',
				'deposit_vat_price' => 'text',
				'deposit_total_price' => 'text',
				'deposit_total_vat' => 'text',
				'deposit_total_vat_price' => 'text',
				'bypass' => 'checkbox',
				'back_order' => 'checkbox',
				'cancelled' => 'checkbox',
				'expected_date' => 'timepicker',
				'product' => 'choice',
				'customer' => 'choice',
				'customerOrder' => 'choice',
				'customerShipment' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'status' => 'sometimes',
			'product_name' => 'sometimes',
			'sales_unit_quantity' => 'sometimes',
			'product_manual_price' => 'sometimes',
			'product_price' => 'sometimes',
			'vat' => 'sometimes',
			'product_vat_price' => 'sometimes',
			'products_quantity' => 'sometimes',
			'packages_quantity' => 'sometimes',
			'total_price' => 'sometimes',
			'total_vat_price' => 'sometimes',
			'deposit_enabled' => 'sometimes',
			'deposit_price' => 'sometimes',
			'deposit_vat' => 'sometimes',
			'deposit_vat_price' => 'sometimes',
			'deposit_total_price' => 'sometimes',
			'deposit_total_vat' => 'sometimes',
			'deposit_total_vat_price' => 'sometimes',
			'bypass' => 'sometimes',
			'back_order' => 'sometimes',
			'cancelled' => 'sometimes',
			'expected_date' => 'sometimes',
			'product' => 'sometimes|exists:products,id',
			'customer' => 'sometimes|exists:customers,id',
			'customerOrder' => 'sometimes|exists:customer_orders,id',
			'customerShipment' => 'sometimes|exists:customer_shipments,id',
        ];
	}

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return array
     */
	public static function getUpdateValidationRules($customerOrderItem)
	{
        return [
			'status' => 'sometimes',
			'product_name' => 'sometimes',
			'sales_unit_quantity' => 'sometimes',
			'product_manual_price' => 'sometimes',
			'product_price' => 'sometimes',
			'vat' => 'sometimes',
			'product_vat_price' => 'sometimes',
			'products_quantity' => 'sometimes',
			'packages_quantity' => 'sometimes',
			'total_price' => 'sometimes',
			'total_vat_price' => 'sometimes',
			'deposit_enabled' => 'sometimes',
			'deposit_price' => 'sometimes',
			'deposit_vat' => 'sometimes',
			'deposit_vat_price' => 'sometimes',
			'deposit_total_price' => 'sometimes',
			'deposit_total_vat' => 'sometimes',
			'deposit_total_vat_price' => 'sometimes',
			'bypass' => 'sometimes',
			'back_order' => 'sometimes',
			'cancelled' => 'sometimes',
			'expected_date' => 'sometimes',
			'product' => 'sometimes|exists:products,id',
			'customer' => 'sometimes|exists:customers,id',
			'customerOrder' => 'sometimes|exists:customer_orders,id',
			'customerShipment' => 'sometimes|exists:customer_shipments,id',
        ];
	}
}