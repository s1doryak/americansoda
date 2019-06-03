<?php

namespace App\Forms\Dashboard;

use App\CustomerInvoiceItem;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerInvoiceItem form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerInvoiceItemForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'position' => 'number',
			'item_code' => 'text',
			'subject' => 'text',
			'definition' => 'text',
			'price' => 'text',
			'unit_type' => 'text',
			'amount' => 'text',
			'sum' => 'text',
			'tax' => 'text',
			'sum_tax' => 'text',
			'discount' => 'text',
			'invoice' => 'choice',
			'orderItem' => 'choice',
        ];
	}

    /**
     * @param CustomerInvoiceItem $customerInvoiceItem
     * @return array
     */
	public static function getEditFormFields($customerInvoiceItem)
	{
        return [
			'position' => 'number',
			'item_code' => 'text',
			'subject' => 'text',
			'definition' => 'text',
			'price' => 'text',
			'unit_type' => 'text',
			'amount' => 'text',
			'sum' => 'text',
			'tax' => 'text',
			'sum_tax' => 'text',
			'discount' => 'text',
			'invoice' => 'choice',
			'orderItem' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'position' => 'sometimes',
			'item_code' => 'sometimes',
			'subject' => 'sometimes',
			'definition' => 'sometimes',
			'price' => 'sometimes',
			'unit_type' => 'sometimes',
			'amount' => 'sometimes',
			'sum' => 'sometimes',
			'tax' => 'sometimes',
			'sum_tax' => 'sometimes',
			'discount' => 'sometimes',
			'invoice' => 'sometimes|exists:customer_invoices,id',
			'orderItem' => 'sometimes|exists:customer_order_items,id',
        ];
	}

    /**
     * @param CustomerInvoiceItem $customerInvoiceItem
     * @return array
     */
	public static function getUpdateValidationRules($customerInvoiceItem)
	{
        return [
			'position' => 'sometimes',
			'item_code' => 'sometimes',
			'subject' => 'sometimes',
			'definition' => 'sometimes',
			'price' => 'sometimes',
			'unit_type' => 'sometimes',
			'amount' => 'sometimes',
			'sum' => 'sometimes',
			'tax' => 'sometimes',
			'sum_tax' => 'sometimes',
			'discount' => 'sometimes',
			'invoice' => 'sometimes|exists:customer_invoices,id',
			'orderItem' => 'sometimes|exists:customer_order_items,id',
        ];
	}
}