<?php

namespace App\Forms\Dashboard;

use App\CustomerPreOrder;
use App\Repositories\Contracts\CustomerPreOrderRepository;
use Crmplease\MaterialAdmin\Forms\Form;

/**
 * CustomerPreOrder form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerPreOrderForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'number' => [
                'type' => 'text',
                'value' => app(CustomerPreOrderRepository::class)->getFirstAvailableNumber()
            ],
            'reference_number' => 'text',
            'comment' => 'textarea',
            'customerUser' => 'choice',
            'customer' => 'choice',
            'customerPreOrderItems[idx]' => [
                'type' => 'relation_form',
                'fields' => CustomerPreOrderItemForm::getCreateFormFields(),
                'form_title' => trans('models/customer_pre_order_item.labels.plural'),
                'resource' => 'customer_pre_order_item',
                'items' => [],
                'can_add' => false,
                'can_edit' => false,
                'can_select' => false,
            ]
        ];
	}

    /**
     * @param CustomerPreOrder $customerPreOrder
     * @return array
     */
    public static function getEditFormFields($customerPreOrder)
    {
        return [
            'number' => 'text',
            'reference_number' => 'text',
            'comment' => 'textarea',
            'customerUser' => 'choice',
            'customer' => 'choice',
            'customerPreOrderItems[idx]' => [
                'type' => 'relation_form',
                'fields' => CustomerPreOrderItemForm::getCreateFormFields(),
                'form_title' => trans('models/customer_pre_order_item.labels.plural'),
                'resource' => 'customer_pre_order_item',
                'items' => $customerPreOrder->items,
                'can_add' => false,
                'can_edit' => false,
                'can_remove' => false,
                'can_select' => false,
            ]
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'number' => 'sometimes',
            'reference_number' => 'sometimes',
            'comment' => 'sometimes',
            'customerUser' => 'sometimes|exists:customer_users,id',
            'customerOrder' => 'sometimes|exists:customer_orders,id',
            'customer' => 'sometimes|exists:customers,id',
        ];
    }

    /**
     * @param CustomerPreOrder $customerPreOrder
     * @return array
     */
    public static function getUpdateValidationRules($customerPreOrder)
    {
        return [
            'number' => 'sometimes',
            'reference_number' => 'sometimes',
            'comment' => 'sometimes',
            'customerUser' => 'sometimes|exists:customer_users,id',
            'customerOrder' => 'sometimes|exists:customer_orders,id',
            'customer' => 'sometimes|exists:customers,id',
        ];
    }
}