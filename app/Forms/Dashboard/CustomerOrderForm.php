<?php

namespace App\Forms\Dashboard;

use App\CustomerOrder;
use App\CustomerOrderItem;
use App\Forms\Traits\UserFieldForm;
use App\Repositories\Contracts\CustomerOrderRepository;
use Crmplease\MaterialAdmin\Forms\Form;

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

        $fields['customer'] = [
            'type' => 'choice',
            'multiple' => false,
            'attr' => [
                'data-live-search' => 'true'
            ]
        ];
        $fields['number'] = [
            'type' => 'text',
            'value' => app(CustomerOrderRepository::class)->getFirstAvailableNumber()
        ];
        $fields['batch_number'] = 'text';

        return $fields;
    }

    /**
     * @param CustomerOrder $customerOrder
     * @return array
     */
    public static function getEditFormFields($customerOrder)
    {
        $fields = [];

        $fields['customer'] = [
            'type' => 'choice',
            'multiple' => false,
            'attr' => [
                'disabled' => true,
            ],
            'value' => $customerOrder->customer->id,
        ];
        $fields['number'] = 'text';
        $fields['batch_number'] = 'text';
        $fields['comment'] = 'editor';
        $fields['customerOrderItems[idx]'] = [
            'type' => 'relation_form',
            'fields' => CustomerOrderItemForm::getCreateFormFields(),
            'form_title' => trans('models/customer_order_item.labels.plural'),
            'resource' => 'customer_order_item',
            'items' => $customerOrder->customerOrderItems,
            'can_add' => true,
            'can_edit' => function ($customerOrderItem = null) {
                $answer = true;

                if ($customerOrderItem instanceof CustomerOrderItem) {
                    $answer = in_array($customerOrderItem->status, ['open', 'assembly', 'shipment']);
                }

                return $answer;
            },
            'can_remove' => function ($customerOrderItem = null) {
                $answer = true;

                if ($customerOrderItem instanceof CustomerOrderItem) {
                    $answer = in_array($customerOrderItem->status, ['open', 'assembly', 'shipment']);
                }

                return $answer;
            },
            'can_select' => function ($customerOrderItem = null) {
                return $customerOrderItem ? false : true;
            },
            'parent_except' => ['status']
        ];

        return $fields;
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'customer' => 'sometimes|exists:customers,id',
            'number' => 'sometimes',
            'customerOrderItems.*.product' => 'sometimes|exists:products,id',
        ];
    }

    /**
     * @param CustomerOrder $customerOrder
     * @return array
     */
    public static function getUpdateValidationRules($customerOrder)
    {
        return [
            'customer' => 'sometimes|exists:customers,id',
            'number' => 'sometimes',
            'customerOrderItems.*.product' => 'sometimes|exists:products,id',
        ];
    }
}
