<?php

namespace App\Forms\Dashboard;

use App\Setting;
use Crmplease\MaterialAdmin\Forms\Form;

class SettingValueForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'key' => [
                'type' => 'text',
                'label' => trans('models/setting.fields.setting_value.key')
            ],
            'value' => [
                'type' => 'text',
                'label' => trans('models/setting.fields.setting_value.value')
            ],
            '_remove' => [
                'type' => 'hidden',
                'value' => 0,
                'attr' => [
                    'data-remove',
                ],
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
            'key' => [
                'type' => 'text',
                'label' => trans('models/setting.fields.setting_value.key')
            ],
            'value' => [
                'type' => 'text',
                'label' => trans('models/setting.fields.setting_value.value')
            ],
        ];
    }
}
