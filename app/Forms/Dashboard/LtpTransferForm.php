<?php

namespace App\Forms\Dashboard;

use App\LtpTransfer;
use App\LtpTransferItem;
use Crmplease\MaterialAdmin\Forms\Form;

/**
 * LtpTransferForm form
 *
 * @package App\Forms\Dashboard
 */
class LtpTransferForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'document_type' => 'text',
            'document_number' => 'text',
            'requested_delivery_date' => 'datepicker',
            'requested_delivery_timestamp' => 'time',
            'document_date' => 'datepicker',
            'warehouse' => 'text',
            'comment' => 'textarea',
            'owner_reference' => 'text',
            'invoice_reference' => 'text',
            'seller_info' => 'text',
            'delivery_route' => 'text',
            'delivery_route_load' => 'text',
            'delivery_drop' => 'text',
            'delivery_class' => 'text',
            'delivery_terminal_info' => 'text',
            'weight' => 'text',
            'volume' => 'text',

            'document_party_type' => 'text',
            'code' => 'text',
            'name' => 'text',
            'address' => 'text',
            'zip' => 'text',
            'city' => 'text',
            'region' => 'text',
            'country' => 'text',
            'information' => 'textarea',
            'iln' => 'text',
            'edi_identifier' => 'text',
            'email' => 'text',
            'phone' => 'text',
        ];
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return array
     */
    public static function getEditFormFields($ltpTransfer)
    {
        return [
            'document_type' => 'text',
            'document_number' => 'text',
            'requested_delivery_date' => 'datepicker',
            'requested_delivery_timestamp' => 'time',
            'document_date' => 'datepicker',
            'warehouse' => 'text',
            'comment' => 'textarea',
            'owner_reference' => 'text',
            'invoicing_reference' => 'text',
            'seller_info' => 'text',
            'delivery_route' => 'text',
            'delivery_route_load' => 'text',
            'delivery_drop' => 'text',
            'delivery_class' => 'text',
            'delivery_terminal_info' => 'text',
            'weight' => 'text',
            'volume' => 'text',

            'document_party_type' => 'text',
            'code' => 'text',
            'name' => 'text',
            'address' => 'text',
            'zip' => 'text',
            'city' => 'text',
            'region' => 'text',
            'country' => 'text',
            'information' => 'text',
            'iln' => 'text',
            'edi_identifier' => 'text',
            'email' => 'text',
            'phone' => 'text',
            'items' => [
                'type' => 'relation_form',
                'fields' => LtpTransferItemForm::getCreateFormFields(),
                'form_title' => trans('models/ltp_transfer_item.labels.plural'),
                'items' => $ltpTransfer->items,
                'resource' => 'ltp_transfer_item',
                'can_add' => false,
                'can_edit' => function ($item = null) {
                    return false;
                },
                'can_select' => function ($item = null) {
                    return false;
                },
                'can_remove' => function ($item = null) {
                    return false;
                },
            ]
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'document_type' => 'sometimes',
            'document_number' => 'sometimes',
            'document_aggregate' => 'sometimes',
            'parent_document_number' => 'sometimes',
            'picking_date' => 'sometimes',
            'requested_delivery_date' => 'sometimes',
            'document_date' => 'sometimes',
            'warehouse' => 'sometimes',
            'comment' => 'sometimes',
            'owner_reference' => 'sometimes',
            'invoice_reference' => 'sometimes',
            'seller_info' => 'sometimes',
            'delivery_route' => 'sometimes',
            'delivery_route_load' => 'sometimes',
            'delivery_drop' => 'sometimes',
            'delivery_class' => 'sometimes',
            'delivery_terminal_info' => 'sometimes',
            'picking_method' => 'sometimes',
            'weight' => 'sometimes',
            'volume' => 'sometimes',
            'status_code' => 'sometimes',
            'delivery_start' => 'sometimes',
            'delivery_end' => 'sometimes',

            'document_party_type' => 'sometimes',
            'code' => 'sometimes',
            'name' => 'sometimes',
            'address' => 'sometimes',
            'zip' => 'sometimes',
            'city' => 'sometimes',
            'region' => 'sometimes',
            'country' => 'sometimes',
            'information' => 'sometimes',
            'iln' => 'sometimes',
            'edi_identifier' => 'sometimes',
            'email' => 'sometimes',
            'phone' => 'sometimes',
        ];
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return array
     */
    public static function getUpdateValidationRules($ltpTransfer)
    {
        return [
            'document_type' => 'sometimes',
            'document_number' => 'sometimes',
            'document_aggregate' => 'sometimes',
            'parent_document_number' => 'sometimes',
            'picking_date' => 'sometimes',
            'requested_delivery_date' => 'sometimes',
            'document_date' => 'sometimes',
            'warehouse' => 'sometimes',
            'comment' => 'sometimes',
            'owner_reference' => 'sometimes',
            'invoice_reference' => 'sometimes',
            'seller_info' => 'sometimes',
            'delivery_route' => 'sometimes',
            'delivery_route_load' => 'sometimes',
            'delivery_drop' => 'sometimes',
            'delivery_class' => 'sometimes',
            'delivery_terminal_info' => 'sometimes',
            'picking_method' => 'sometimes',
            'weight' => 'sometimes',
            'volume' => 'sometimes',
            'status_code' => 'sometimes',
            'delivery_start' => 'sometimes',
            'delivery_end' => 'sometimes',

            'document_party_type' => 'sometimes',
            'code' => 'sometimes',
            'name' => 'sometimes',
            'address' => 'sometimes',
            'zip' => 'sometimes',
            'city' => 'sometimes',
            'region' => 'sometimes',
            'country' => 'sometimes',
            'information' => 'sometimes',
            'iln' => 'sometimes',
            'edi_identifier' => 'sometimes',
            'email' => 'sometimes',
            'phone' => 'sometimes',
        ];
    }
}
