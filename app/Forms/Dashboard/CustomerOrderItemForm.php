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
		if (is_page('split')) {
			return [
				'sales_unit_quantity' => 'text',
				'a_quantity' => 'text',
				'b_quantity' => 'text',
				'b_back_order' => 'checkbox',
				'submit' => null,
			];
		}

		$fields = [];


		$fields['product'] = [
			'type' => 'choice',
			'multiple' => false,
		];
		$fields['sales_unit_quantity'] = [
			'type' => 'text',
		];
		$fields['products_quantity'] = [
			'type' => 'static',
		];
		$fields['bypass'] = [
			'type' => 'checkbox',
			'ts-color' => 'blue',
		];
		$fields['back_order'] = [
			'type' => 'checkbox',
			'ts-color' => 'red',
		];
		$fields['cancelled'] = [
			'type' => 'checkbox',
			'ts-color' => 'red',
		];
		$fields['expected_date'] = [
			'type' => 'datepicker',
		];
		$fields['product_manual_price'] = [
			'type' => 'checkbox',
			'ts-color' => 'blue',
		];
		$fields['product_price'] = [
			'type' => 'text',
		];
		$fields['product_vat_price'] = [
			'type' => 'static',
		];
		if (in_array(resource_name(), ['customer_shipment', 'customer.shipment'])) {
			$fields['customerOrder'] = [
				'type' => 'entity',
				'class' => \App\CustomerOrder::class,
				'property' => 'number',
				'property_key' => 'id',
				'template' => 'dashboard::resources.customer_order_item.fields.customerOrder',
			];
		}
		$fields['status'] = [
			'type' => 'static',
			'template' => 'dashboard::resources.customer_order_item.fields.status',
		];
		$fields['id'] = [
			'type' => 'hidden',
		];
		$fields['_remove'] = [
			'type' => 'hidden',
			'value' => 0,
			'attr' => [
				'data-remove',
			],
		];

		$fields['submit'] = null;

		return $fields;
	}

	/**
	 * @param CustomerOrderItem $customerOrderItem
	 * @return array
	 */
	public static function getEditFormFields($customerOrderItem)
	{
		if (is_page('split')) {
			return [
				'sales_unit_quantity' => 'text',
				'a_quantity' => 'text',
				'b_quantity' => 'text',
				'b_back_order' => 'checkbox',
				'submit' => null,
			];
		}

		$fields = [];

		$fields['product'] = [
			'type' => 'choice',
			'multiple' => false,
		];
		$fields['sales_unit_quantity'] = [
			'type' => 'text',
		];
		$fields['products_quantity'] = [
			'type' => 'static',
		];
		$fields['bypass'] = [
			'type' => 'checkbox',
			'ts-color' => 'blue',
		];
		$fields['back_order'] = [
			'type' => 'checkbox',
			'ts-color' => 'red',
		];
		$fields['expected_date'] = [
			'type' => 'datepicker',
		];
		$fields['product_manual_price'] = [
			'type' => 'checkbox',
			'ts-color' => 'blue',
		];
		$fields['product_price'] = [
			'type' => 'text',
		];
		$fields['product_vat_price'] = [
			'type' => 'static',
		];
		if (in_array(resource_name(), ['customer_shipment', 'customer.shipment'])) {
			$fields['customerOrder'] = [
				'type' => 'entity',
				'class' => \App\CustomerOrder::class,
				'property' => 'number',
				'property_key' => 'id',
				'template' => 'dashboard::resources.customer_order_item.fields.customerOrder',
			];
		}
		$fields['status'] = [
			'type' => 'static',
			'template' => 'dashboard::resources.customer_order_item.fields.status',
		];
		$fields['cancelled'] = [
			'type' => 'checkbox',
			'ts-color' => 'red',
		];
		$fields['id'] = [
			'type' => 'hidden',
		];
		$fields['_remove'] = [
			'type' => 'hidden',
			'value' => 0,
			'attr' => [
				'data-remove',
			],
		];

		$fields['submit'] = null;

		return $fields;
	}

	/**
	 * @return array
	 */
	public static function getStoreValidationRules()
	{
		return [
			'number' => 'required',
			'sales_unit_quantity' => 'required',
			'product_price' => 'required|integer',
			'expected_date' => 'required|date',
			'customerOrder' => 'required|exists:customer_orders,id',
			'product' => 'required|exists:products,id',
		];
	}

	/**
	 * @param CustomerOrderItem $customerOrderItem
	 * @return array
	 */
	public static function getUpdateValidationRules($customerOrderItem)
	{
		return [
			'number' => 'required',
			'sales_unit_quantity' => 'required',
			'product_price' => 'required|integer',
			'expected_date' => 'required|date',
			'customerOrder' => 'required|exists:customer_orders,id',
			'product' => 'required|exists:products,id',
		];
	}
}