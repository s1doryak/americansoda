<?php

namespace App\Forms\Dashboard;

use App\LtpTransferItem;

class LtpTransferItemForm
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'product_code' => 'text',
            'product_name' => 'text',
            'product_ean' => 'text',
            'original_quantity' => 'text',
            'processed_quantity' => 'text',
            'picked' => [
                'type' => 'text',
                'value' => function ($value) {
                    return sprintf('%s&nbsp;%%', $value ?: 0) ;
                }
            ],
            'product_unit' => 'text',
        ];
    }

    /**
     * @param LtpTransferItem $ltpTransferItem
     * @return array
     */
    public static function getEditFormFields($ltpTransferItem)
    {
        return [
            'product_code' => 'text',
            'product_name' => 'text',
            'product_ean' => 'text',
            'original_quantity' => 'text',
            'processed_quantity' => 'text',
            'picked' => 'text',
            'product_unit' => 'text',
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'product_code' => 'sometimes',
            'product_name' => 'sometimes',
            'product_ean' => 'sometimes',
            'product_unit' => 'sometimes',
            'original_quantity' => 'sometimes',
            'processed_quantity' => 'sometimes',
            'picked' => 'sometimes',
        ];
    }

    /**
     * @param LtpTransferItem $ltpTransferItem
     * @return array
     */
    public static function getUpdateValidationRules($ltpTransferItem)
    {
        return [
            'product_code' => 'sometimes',
            'product_name' => 'sometimes',
            'product_ean' => 'sometimes',
            'product_unit' => 'sometimes',
            'original_quantity' => 'sometimes',
            'processed_quantity' => 'sometimes',
            'picked' => 'sometimes',
        ];
    }
}
