<?php

return [
    'labels' => [
        'singular' => 'Setting',
        'plural' => 'Settings',
        'create' => 'Create Setting'
    ],
    'index' => [
        'title' => 'List of Settings',
    ],
    'trashed' => [
        'title' => 'List of trashed Settings',
    ],
    'create' => [
        'title' => 'Create Setting',
    ],
    'store' => [
        'success' => 'Setting created successfully!',
        'error' => 'Setting created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Setting',
    ],
    'edit' => [
        'title' => 'Edit Setting',
    ],
    'update' => [
        'success' => 'Setting updated successfully!',
        'error' => 'Setting updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move Setting to trash',
        'success' => 'Setting trashed successfully!',
        'error' => 'Setting trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore Setting',
        'success' => 'Setting restored successfully!',
        'error' => 'Setting restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Setting',
        'success' => 'Setting destroyed successfully!',
        'error' => 'Setting destroyed unsuccessfully!'
    ],
    //    'customAction' => [
    //        'title' => 'Setting custom action',
    //        'success' => 'Setting custom action completed successfully!',
    //        'redirect' => 'Setting custom action completed successfully!',
    //        'error' => 'Setting custom action completed unsuccessfully!',
    //    ],
    'fields' => [
		'name' => 'Name',
		'value' => 'Value',
        'setting_value' => [
            'key' => 'Key',
            'value' => 'Value',
            'additional' => 'Additional',
            'labels' => [
                'plural' => 'Values'
            ]
        ]

    ],
    'placeholders' => [

    ],
    'columns' => [
		'name' => 'Name',
		'value' => 'Value',

        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [

    ],
];
