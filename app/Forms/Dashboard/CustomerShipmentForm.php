<?php

namespace App\Forms\Dashboard;

use App\CustomerShipment;
use App\Forms\Traits\UserFieldForm;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerShipment form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerShipmentForm extends Form
{
	use UserFieldForm;

	/**
	 * @return array
	 */
	public static function getCreateFormFields()
	{
		$fields = [];

		$fields['user'] = static::provideUserFormField();

		/**
		 * При создании отгрузки заполнять поле клиент в зависимости от того, с какой страницы происходит создание.
		 */
		if (resource_name() === 'customer.shipment') {
			$fields['customer'] = [
				'type' => 'hidden',
				'value' => resource_id('customer'),
			];
		} else {
			$fields['customer'] = 'choice';
		}

		$fields['number'] = [
			'type' => 'text',
			'value' => CustomerShipment::getDefaultNumber(),
		];

		$fields['packageType'] = 'choice';
		$fields['packages_quantity'] = [
			'type' => 'number',
			'attr' => [
				'min' => 0,
			],
		];

		$fields['assembly_number'] = 'text';

		$fields['invoice_number'] = 'text';

		$fields['comment'] = 'editor';

		$item = [
			'type' => 'relation_form',
			'fields' => CustomerOrderItemForm::getCreateFormFields(),
			'form_title' => trans('models/customer.order.item.labels.plural'),
			'resource' => 'customer.order.item',
			'items' => [],
			'can_add' => false,
			'can_edit' => function ($item = null) {
				return false;
			},
			'can_select' => function ($item = null) {
				return false;
			},
			'can_remove' => function ($item = null) {
				return false;
			},
		];

		$fields['customerOrderItems[0]'] = $item;

		return $fields;
	}

	/**
	 * @param CustomerShipment $customerShipment
	 * @return array
	 */
	public static function getEditFormFields($customerShipment)
	{
		$fields = [];

		$fields['user'] = static::provideUserFormField($customerShipment);

		/**
		 * При создании отгрузки заполнять поле клиент в зависимости от того, с какой страницы происходит создание.
		 */
		if (resource_name() === 'customer.shipment') {
			$fields['customer'] = [
				'type' => 'hidden',
				'value' => resource_id('customer'),
			];
		} else {
			$fields['customer_id'] = [
				'type' => 'choice',
				'multiple' => false,
				'attr' => [
					'disabled' => true,
				],
				'value' => $customerShipment->customer->id,
			];

			$fields['customer'] = [
				'type' => 'hidden',
				'value' => $customerShipment->customer->id,
			];
		}

		$fields['number'] = [
			'type' => 'text',
			'value' => $customerShipment->number ?: CustomerShipment::getDefaultNumber(),
		];

		$fields['packageType'] = [
			'type' => 'choice',
			'multiple' => false,
		];
		$fields['packages_quantity'] = [
			'type' => 'number',
			'attr' => [
				'min' => 0,
			],
		];

		$fields['assembly_number'] = 'text';

		$fields['invoice_number'] = 'text';

		$fields['comment'] = 'editor';

		$item = [
			'type' => 'relation_form',
			'fields' => CustomerOrderItemForm::getCreateFormFields(),
			'form_title' => trans('models/customer.order.item.labels.plural'),
			'resource' => 'customer.order.item',
			'items' => $customerShipment->customerOrderItems,
			'can_add' => false,
			'can_edit' => function ($item = null) {
				return false;
			},
			'can_select' => function ($item = null) {
				return false;
			},
			'can_remove' => function ($item = null) {
				if (is_object($item)) {
					return in_array($item->status, ['open', 'assembly', 'shipment']);
				}
				return true;
			},
		];

		$fields['customerOrderItems[0]'] = $item;

		return $fields;
	}

	/**
	 * @return array
	 */
	public static function getStoreValidationRules()
	{
		return [

		];
	}

	/**
	 * @param CustomerShipment $customerShipment
	 * @return array
	 */
	public static function getUpdateValidationRules($customerShipment)
	{
		return [

		];
	}
}