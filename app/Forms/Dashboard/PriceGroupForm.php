<?php

namespace App\Forms\Dashboard;

use App\PriceGroup;
use Crmplease\MaterialAdmin\Forms\Form;

/**
 * PriceGroup form.
 *
 * @package App\Forms\Dashboard
 */
class PriceGroupForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'name' => 'text',
            'manual' => 'checkbox',
            'priceGroupBreakpoints[idx]' => [
                'type' => 'relation_form',
                'fields' => PriceGroupBreakpointForm::getCreateFormFields(),
                'form_title' => trans('models/price_group_breakpoint.labels.plural'),
                'resource' => 'price_group_breakpoint',
                'items' => [],
                'can_add' => true,
                'can_edit' => true,
                'can_remove' => true,
                'can_select' => true,
            ],
        ];
    }

    /**
     * @param PriceGroup $priceGroup
     * @return array
     */
    public static function getEditFormFields($priceGroup)
    {
        return [
            'name' => 'text',
            'manual' => 'checkbox',
            'priceGroupBreakpoints[idx]' => [
                'type' => 'relation_form',
                'fields' => PriceGroupBreakpointForm::getCreateFormFields(),
                'form_title' => trans('models/price_group_breakpoint.labels.plural'),
                'resource' => 'price_group_breakpoint',
                'items' => $priceGroup->priceGroupBreakpoints,
                'can_add' => true,
                'can_edit' => true,
                'can_remove' => true,
                'can_select' => true,
            ],
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'name' => 'sometimes',
            'manual' => 'sometimes',
            'priceGroupBreakpoints.*.breakpoint' => 'sometimes',
        ];
    }

    /**
     * @param PriceGroup $priceGroup
     * @return array
     */
    public static function getUpdateValidationRules($priceGroup)
    {
        return [
            'name' => 'sometimes',
            'manual' => 'sometimes',
            'priceGroupBreakpoints.*.breakpoint' => 'sometimes',
        ];
    }
}
