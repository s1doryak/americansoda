<?php

namespace App\Forms\Dashboard;

use App\CustomerInvoice;
use App\CustomerInvoiceItem;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerInvoice form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerInvoiceForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'companyBankAccounts' => 'choice',
            'date' => [
                'type' => 'datepicker',
                'value' => now()->format('Y-m-d')
            ],
            'invoice_nr' => [
                'type' => 'text',
                'value' => app(CustomerInvoiceRepository::class)->getFirstAvailableNumber()
            ],
            'customer' => 'choice',
            'customerShipment' => [
                'type' => 'choice',
                'lists' => 'number',
            ],
            'customerInvoiceItems[idx]' => [
                'type' => 'relation_form',
                'fields' => CustomerInvoiceItemForm::getCreateFormFields(),
                'form_title' => trans('models/customer_invoice_item.labels.plural'),
                'resource' => 'customer_invoice_item',
                'items' => [],
                'can_add' => true,
                'can_edit' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
                'can_remove' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
                'can_select' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
            ],
            'notes' => 'textarea',
        ];
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return array
     */
    public static function getEditFormFields($customerInvoice)
    {
        return [
            'companyBankAccounts' => 'choice',
            'date' => 'datepicker',
            'invoice_nr' => 'text',
            'customer' => 'choice',
            'customerShipment' => [
                'type' => 'choice',
                'lists' => 'number',
            ],
            'customerInvoiceItems[idx]' => [
                'type' => 'relation_form',
                'fields' => CustomerInvoiceItemForm::getCreateFormFields(),
                'form_title' => trans('models/customer_invoice_item.labels.plural'),
                'resource' => 'customer_invoice_item',
                'items' => $customerInvoice->customerInvoiceItems,
                'can_add' => true,
                'can_edit' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
                'can_remove' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
                'can_select' => function (CustomerInvoiceItem $customerInvoiceItem = null) {
                    return true;
                },
            ],
            'notes' => 'textarea',
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'companyBankAccounts' => 'sometimes|exists:company_bank_accounts,id',
            'date' => 'sometimes',
            'order_nr' => 'sometimes',
            'customer' => 'sometimes|exists:customers,id',
            'customerShipment' => 'sometimes|exists:customer_shipments,id',
            'customerOrderItems.*.subject' => 'sometimes',
            'notes' => 'sometimes',
        ];
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return array
     */
    public static function getUpdateValidationRules($customerInvoice)
    {
        return [
            'companyBankAccounts' => 'sometimes|exists:company_bank_accounts,id',
            'date' => 'sometimes',
            'order_nr' => 'sometimes',
            'customer' => 'sometimes|exists:customers,id',
            'customerShipment' => 'sometimes|exists:customer_shipments,id',
            'customerOrderItems.*.subject' => 'sometimes',
            'notes' => 'sometimes',
        ];
    }
}
