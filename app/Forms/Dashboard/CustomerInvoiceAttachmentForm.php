<?php

namespace App\Forms\Dashboard;

use App\CustomerInvoiceAttachment;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerInvoiceAttachment form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerInvoiceAttachmentForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'attachment_type' => 'text',
			'filename' => 'text',
			'file' => 'text',
			'customerInvoice' => 'choice',
        ];
	}

    /**
     * @param CustomerInvoiceAttachment $customerInvoiceAttachment
     * @return array
     */
	public static function getEditFormFields($customerInvoiceAttachment)
	{
        return [
			'attachment_type' => 'text',
			'filename' => 'text',
			'file' => 'text',
			'customerInvoice' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'attachment_type' => 'sometimes',
			'filename' => 'sometimes',
			'file' => 'sometimes',
			'customerInvoice' => 'sometimes|exists:customer_invoices,id',
        ];
	}

    /**
     * @param CustomerInvoiceAttachment $customerInvoiceAttachment
     * @return array
     */
	public static function getUpdateValidationRules($customerInvoiceAttachment)
	{
        return [
			'attachment_type' => 'sometimes',
			'filename' => 'sometimes',
			'file' => 'sometimes',
			'customerInvoice' => 'sometimes|exists:customer_invoices,id',
        ];
	}
}