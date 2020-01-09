<?php

namespace App\Forms\Dashboard;

use App\Banner;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Banner form.
 *
 * @package App\Forms\Dashboard
 */
class BannerForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'name' => 'text',
            'image' => 'image',
            'url' => 'text',
            'customerTypes' => [
                'type' => 'choice',
                'multiple' => true,
            ],
        ];
    }

    /**
     * @param Banner $banner
     * @return array
     */
    public static function getEditFormFields($banner)
    {
        return [
            'name' => 'text',
            'image' => 'image',
            'url' => 'text',
            'customerTypes' => [
                'type' => 'choice',
                'multiple' => true,
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
            'image' => 'sometimes',
            'url' => 'sometimes',
            'customerTypes' => 'sometimes|exists:customer_types,id',
        ];
    }

    /**
     * @param Banner $banner
     * @return array
     */
    public static function getUpdateValidationRules($banner)
    {
        return [
            'name' => 'sometimes',
            'image' => 'sometimes',
            'url' => 'sometimes',
            'customerTypes' => 'sometimes|exists:customer_types,id',
        ];
    }
}
