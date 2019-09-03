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
            'id' => [
                'type' => 'hidden'
            ],
            'customerOrderItem' => [
                'type' => 'hidden',
            ],
            'product' => [
                'type' => 'hidden',
            ],
            '_remove' => [
                'type' => 'hidden',
                'value' => 0,
                'attr' => [
                    'data-remove',
                ],
            ],
            //'position' => 'number',
            //'item_code' => 'text',
            'subject' => 'text',
            'definition' => 'text',
            'price' => 'text',
            'unit_type' => 'text',
            'amount' => [
                'type' => 'text',
                'value' => 1
            ],
            'sum' => [
                'type' => 'text',
                'attr' => [
                    'disabled' => true,
                ]
            ],
            'tax' => [
                'type' => 'text',
                'value' => 24
            ],
            'sum_tax' => [
                'type' => 'text',
                'attr' => [
                    'disabled' => true,
                ]
            ],
            //'discount' => 'text',
            //'customerInvoice' => 'choice',
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
            'customerInvoice' => 'choice',
            'customerOrderItem' => 'choice',
            'product' => 'choice',
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
            'customerInvoice' => 'sometimes|exists:customer_invoices,id',
            'customerOrderItem' => 'sometimes|exists:customer_order_items,id',
            'product' => 'sometimes|exists:products,id',
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
            'customerInvoice' => 'sometimes|exists:customer_invoices,id',
            'customerOrderItem' => 'sometimes|exists:customer_order_items,id',
            'product' => 'sometimes|exists:products,id',
        ];
    }
}
