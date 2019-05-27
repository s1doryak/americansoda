<?php

namespace App\Forms\Dashboard;

use App\CustomerOrder;
use App\Forms\Traits\UserFieldForm;
use App\Repositories\Contracts\CustomerOrderRepository;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerOrder form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerOrderForm extends Form
{
	use UserFieldForm;

	/**
	 * @return array
	 */
	public static function getCreateFormFields()
	{
		$fields = [];

		$fields['user'] = static::provideUserFormField();

		if (resource_name() === 'customer.order') {
			$fields['customer'] = [
				'type' => 'hidden',
				'value' => resource_id('customer'),
			];
		} else {
			$fields['customer'] = [
				'type' => 'choice',
				'multiple' => false,
			];
		}

		$fields['number'] = [
			'type' => 'text',
			'value' => app(CustomerOrderRepository::class)->getFirstAvailableNumber()
		];
		$fields['batch_number'] = 'text';
		$fields['comment'] = 'editor';

		$item = [
			'type' => 'relation_form',
			'fields' => CustomerOrderItemForm::getCreateFormFields(),
			'form_title' => trans('models/customer_order_item.labels.plural'),
			'resource' => 'customer_order_item',
			'items' => collect([]),
			'can_add' => true,
			'can_edit' => function ($item = null) {
				return true;
			},
			'can_select' => function ($item = null) {
				return true;
			},
		];

		$fields['customerOrderItems[0]'] = $item;

		return $fields;
	}

	/**
	 * @param CustomerOrder $customerOrder
	 * @return array
	 */
	public static function getEditFormFields($customerOrder)
	{
		$fields = [];

		$fields['user'] = static::provideUserFormField($customerOrder);

		if (resource_name() === 'customer.order') {
			$fields['customer'] = [
				'type' => 'hidden',
				'value' => resource_id('customer'),
			];
		} else {
			$fields['customer'] = [
				'type' => 'choice',
				'multiple' => false,
				'attr' => [
					'disabled' => true,
				],
				'value' => $customerOrder->customer->id,
			];

			/*$fields['customer'] = [
				'type' => 'hidden',
				'value' => $customerOrder->customer->id,
			];*/
		}

		$fields['number'] = 'text';
		$fields['batch_number'] = 'text';
		$fields['comment'] = 'editor';

		$item = [
			'type' => 'relation_form',
			'fields' => CustomerOrderItemForm::getCreateFormFields(),
			'form_title' => trans('models/customer_order_item.labels.plural'),
			'resource' => 'customer_order_item',
			'items' => $customerOrder->customerOrderItems,
			'can_add' => true,
			'can_edit' => function ($item = null) {
				if (is_object($item)) {
					return in_array($item->status, ['open', 'assembly', 'shipment']);
				}
				return true;
			},
			'can_remove' => function ($item = null) {
				if (is_object($item)) {
					return in_array($item->status, ['open', 'assembly', 'shipment']);
				}
				return true;
			},
			'can_select' => function ($item = null) {
				if (is_object($item)) {
					return false;
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
			'user' => 'required|exists:users,id',
			'customer' => 'required|exists:customers,id',
			'number' => 'required',
			'customerOrderItems.*.product' => 'required|exists:products,id',
		];
	}

	/**
	 * @param CustomerOrder $customerOrder
	 * @return array
	 */
	public static function getUpdateValidationRules($customerOrder)
	{
		return [
			'user' => 'required|exists:users,id',
			'customer' => 'required|exists:customers,id',
			'number' => 'required',
			'customerOrderItems.*.product' => 'required|exists:products,id',
		];
	}
}