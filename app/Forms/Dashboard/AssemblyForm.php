<?php

namespace App\Forms\Dashboard;

use App\Assembly;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Assembly form.
 *
 * @package App\Forms\Dashboard
 */
class AssemblyForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'number' => 'text',
            'comment' => 'editor',
        ];
    }

    /**
     * @param Assembly $assembly
     * @return array
     */
    public static function getEditFormFields($assembly)
    {
        return [
            'number' => 'text',
            'comment' => 'editor',
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'number' => 'sometimes',
            'comment' => 'sometimes',
        ];
    }

    /**
     * @param Assembly $assembly
     * @return array
     */
    public static function getUpdateValidationRules($assembly)
    {
        return [
            'number' => 'sometimes',
            'comment' => 'sometimes',
        ];
    }
}
