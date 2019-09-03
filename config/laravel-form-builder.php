<?php

return [
    'defaults' => [
        'wrapper_class' => 'form-group',
        'wrapper_error_class' => 'has-error',
        'label_class' => 'control-label',
        'field_class' => 'form-control',
        'field_error_class' => '',
        'help_block_class' => 'help-block',
        'error_class' => 'text-danger',
        'required_class' => 'required',

        'entity' => [
            'wrapper_class' => 'form-group',
            'label_class' => 'control-label',
            'field_class' => 'form-control selectpicker',
        ],

        'choice' => [
            'wrapper_class' => 'form-group',
            'label_class' => 'control-label',
            'field_class' => 'form-control selectpicker',
        ],

        'select' => [
            'wrapper_class' => 'form-group',
            'label_class' => 'control-label',
            'field_class' => 'form-control selectpicker',
        ],
    ],
    // Templates
    'form' => 'laravel-form-builder::form',
    'text' => 'laravel-form-builder::text',
    'textarea' => 'laravel-form-builder::textarea',
    'button' => 'laravel-form-builder::button',
    'buttongroup' => 'laravel-form-builder::buttongroup',
    'radio' => 'laravel-form-builder::radio',
    'checkbox' => 'laravel-form-builder::custom.checkbox',
    'select' => 'laravel-form-builder::custom.select',
    'choice' => 'laravel-form-builder::custom.choice',
    'repeated' => 'laravel-form-builder::repeated',
    'child_form' => 'laravel-form-builder::child_form',
    'collection' => 'laravel-form-builder::collection',
    'static' => 'laravel-form-builder::static',
    'colorpicker' => 'laravel-form-builder::custom.colorpicker',
    'datepicker' => 'laravel-form-builder::custom.datepicker',
    'editor' => 'laravel-form-builder::custom.editor',
    'file' => 'laravel-form-builder::custom.file',
    'image' => 'laravel-form-builder::custom.image',

    'relation_form' => 'dashboard::forms.relation',

    // Remove the laravel-form-builder:: prefix above when using template_prefix
    'template_prefix' => '',

    'default_namespace' => '',

    'custom_fields' => [
        'colorpicker' => \Crmplease\MaterialAdmin\Forms\Fields\Colorpicker::class,
        'datepicker' => \Crmplease\MaterialAdmin\Forms\Fields\Datepicker::class,
        'editor' => \Crmplease\MaterialAdmin\Forms\Fields\Editor::class,
        'file' => \Crmplease\MaterialAdmin\Forms\Fields\File::class,
        'image' => \Crmplease\MaterialAdmin\Forms\Fields\Image::class,
        'relation_form' => \App\Forms\Fields\RelationFormType::class,
    ]
];
