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
                'value' => now()->format('Y-m-d'),
                'attr' => [
                    'format' => 'YYYY/MM/DD'
                ]
            ],
            'invoice_nr' => [
                'type' => 'text',
                'value' => app(CustomerInvoiceRepository::class)->getFirstAvailableNumber()
            ],
            'customer' => [
                'type' => 'choice'
            ],
            'order_nr' => [
                'type' => 'text',
            ],
            'company_reference' => [
                'type' => 'text',
            ],
            'customerInvoiceItems[idx]' => [
                'type' => 'relation_form',
                'fields' => CustomerInvoiceItemForm::getCreateFormFields(),
                'form_title' => trans('models/customer_invoice_item.labels.plural'),
                'resource' => 'customer_invoice_item',
                'items' => [],
                'can_add' => true,
                'can_edit' => function ($customerInvoiceItem = null) {
                    return true;
                },
                'can_remove' => function ($customerInvoiceItem = null) {
                    return true;
                },
                'can_select' => function ($customerInvoiceItem = null) {
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
            'companyBankAccounts' => [
                'type' => 'choice',
            ],
            'customer' => [
                'type' => 'choice'
            ],
            'customerShipment' => $customerInvoice->customerShipment ? [
                'type' => 'choice',
                'lists' => 'number',
            ] : null,
            'date' => [
                'type' => 'datepicker',
                'attr' => [
                    'format' => 'YYYY/MM/DD'
                ]
            ],
            'invoice_nr' => [
                'type' => 'text'
            ],
            'reference_nr' => [
                'type' => 'text',
                'attr' => [
                    'disabled' => true
                ]
            ],
            'sum' => [
                'type' => 'text',
                'attr' => [
                    'disabled' => true
                ]
            ],
            'sum_tax' => [
                'type' => 'text',
                'attr' => [
                    'disabled' => true
                ]
            ],
            'customerInvoiceItems[idx]' => [
                'type' => 'relation_form',
                'fields' => CustomerInvoiceItemForm::getCreateFormFields(),
                'form_title' => trans('models/customer_invoice_item.labels.plural'),
                'resource' => 'customer_invoice_item',
                'items' => $customerInvoice->customerInvoiceItems,
                'can_add' => true,
                'can_edit' => function ($customerInvoiceItem = null) {
                    return true;
                },
                'can_remove' => function ($customerInvoiceItem = null) {
                    return true;
                },
                'can_select' => function ($customerInvoiceItem = null) {
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
			'maventa_paid' => 'sometimes',
			'maventa_sent_at' => 'sometimes',
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
			'maventa_paid' => 'sometimes',
			'maventa_sent_at' => 'sometimes',
        ];
    }
}
