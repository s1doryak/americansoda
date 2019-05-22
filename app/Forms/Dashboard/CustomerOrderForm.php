<?php

namespace App\Forms\Dashboard;

use App\CustomerOrder;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerOrder form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerOrderForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'number' => 'text',
				'batch_number' => 'text',
				'comment' => 'editor',
				'fc_overdue' => 'number',
				'fc_comment' => 'editor',
				'fc_future_comment' => 'editor',
				'sent_at' => 'timepicker',
				'customer' => 'choice',
				'user' => 'choice',
        ];
	}

    /**
     * @param CustomerOrder $customerOrder
     * @return array
     */
	public static function getEditFormFields($customerOrder)
	{
        return [
				'number' => 'text',
				'batch_number' => 'text',
				'comment' => 'editor',
				'fc_overdue' => 'number',
				'fc_comment' => 'editor',
				'fc_future_comment' => 'editor',
				'sent_at' => 'timepicker',
				'customer' => 'choice',
				'user' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'number' => 'sometimes',
			'batch_number' => 'sometimes',
			'comment' => 'sometimes',
			'fc_overdue' => 'sometimes',
			'fc_comment' => 'sometimes',
			'fc_future_comment' => 'sometimes',
			'sent_at' => 'sometimes',
			'customer' => 'sometimes|exists:customers,id',
			'user' => 'sometimes|exists:users,id',
        ];
	}

    /**
     * @param CustomerOrder $customerOrder
     * @return array
     */
	public static function getUpdateValidationRules($customerOrder)
	{
        return [
			'number' => 'sometimes',
			'batch_number' => 'sometimes',
			'comment' => 'sometimes',
			'fc_overdue' => 'sometimes',
			'fc_comment' => 'sometimes',
			'fc_future_comment' => 'sometimes',
			'sent_at' => 'sometimes',
			'customer' => 'sometimes|exists:customers,id',
			'user' => 'sometimes|exists:users,id',
        ];
	}
}