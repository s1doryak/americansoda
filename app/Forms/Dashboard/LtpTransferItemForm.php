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
            'product_identifier_class_id' => 'text',
            'product_name' => 'text',
            'product_ean' => 'text',
            'quantity_selling_unit' => 'text',
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
            'product_identifier_class_id' => 'text',
            'product_name' => 'text',
            'product_ean' => 'text',
            'quantity_selling_unit' => 'text',
            'product_unit' => 'text',
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'product_identifier_class_id' => 'sometimes',
            'product_name' => 'sometimes',
            'product_ean' => 'sometimes',
            'quantity_selling_unit' => 'sometimes',
            'product_unit' => 'sometimes',
        ];
    }

    /**
     * @param LtpTransferItem $ltpTransferItem
     * @return array
     */
    public static function getUpdateValidationRules($ltpTransferItem)
    {
        return [
            'product_identifier_class_id' => 'sometimes',
            'product_name' => 'sometimes',
            'product_ean' => 'sometimes',
            'quantity_selling_unit' => 'sometimes',
            'product_unit' => 'sometimes',
        ];
    }
}
