<?php

namespace App\Forms\Dashboard;

use App\CustomerInvoiceAction;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerInvoiceAction form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerInvoiceActionForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'action' => 'text',
			'timestamp' => 'datepicker',
			'customerInvoice' => 'choice',
        ];
	}

    /**
     * @param CustomerInvoiceAction $customerInvoiceAction
     * @return array
     */
	public static function getEditFormFields($customerInvoiceAction)
	{
        return [
			'action' => 'text',
			'timestamp' => 'datepicker',
			'customerInvoice' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'action' => 'sometimes',
			'timestamp' => 'sometimes',
			'customerInvoice' => 'sometimes|exists:customer_invoices,id',
        ];
	}

    /**
     * @param CustomerInvoiceAction $customerInvoiceAction
     * @return array
     */
	public static function getUpdateValidationRules($customerInvoiceAction)
	{
        return [
			'action' => 'sometimes',
			'timestamp' => 'sometimes',
			'customerInvoice' => 'sometimes|exists:customer_invoices,id',
        ];
	}
}