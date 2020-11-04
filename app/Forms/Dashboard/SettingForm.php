<?php

namespace App\Forms\Dashboard;

use App\Setting;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Setting form.
 *
 * @package App\Forms\Dashboard
 */
class SettingForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'name' => 'text',
            'value[idx]' => [
                'type' => 'relation_form',
                'form_title' => trans('models/setting.fields.setting_value.labels.plural'),
                'resource' => 'setting_item',
                'fields' => SettingValueForm::getCreateFormFields(),
                'items' => [],
                'can_add' => true,
                'can_edit' => function ($setting = null) {
                    return true;
                },
                'can_remove' => function ($setting = null) {
                    return true;
                },
                'can_select' => function ($setting = null) {
                    return true;
                },
            ],
        ];
    }

    /**
     * @param Setting $setting
     * @return array
     */
    public static function getEditFormFields($setting)
    {
        return [
            'name' => 'text',
            'value[idx]' => [
                'type' => 'relation_form',
                'form_title' => trans('models/setting.fields.setting_value.labels.plural'),
                'resource' => 'setting_item',
                'fields' => SettingValueForm::getCreateFormFields(),
                'items' => $setting->value,
                'parent_except' => [
                  'value'
                ],
                'can_add' => true,
                'can_edit' => function ($setting = null) {
                    return true;
                },
                'can_remove' => function ($setting = null) {
                    return true;
                },
                'can_select' => function ($setting = null) {
                    return true;
                },
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
            'value' => 'sometimes',
        ];
    }

    /**
     * @param Setting $setting
     * @return array
     */
    public static function getUpdateValidationRules($setting)
    {
        return [
            'name' => 'sometimes',
            'value' => 'sometimes',
        ];
    }
}
