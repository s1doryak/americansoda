<?php

namespace App\Forms\Dashboard;

use App\CustomerPreOrder;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

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
			'number' => 'text',
			'reference_number' => 'text',
			'comment' => 'textarea',
			'customerUser' => 'choice',
			'customerOrder' => 'choice',
			'customer' => 'choice',
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
			'customerOrder' => 'choice',
			'customer' => 'choice',
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