<?php

return [
    'labels' => [
        'singular' => 'Auth Log',
        'plural' => 'Auth Logs',
        'create' => 'Create Auth Log'
    ],
    'index' => [
        'title' => 'List of Auth Logs',
    ],
    'trashed' => [
        'title' => 'List of trashed Auth Logs',
    ],
    'create' => [
        'title' => 'Create Auth Log',
    ],
    'store' => [
        'success' => 'Auth Log created successfully!',
        'error' => 'Auth Log created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Auth Log',
    ],
    'edit' => [
        'title' => 'Edit Auth Log',
    ],
    'update' => [
        'success' => 'Auth Log updated successfully!',
        'error' => 'Auth Log updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move Auth Log to trash',
        'success' => 'Auth Log trashed successfully!',
        'error' => 'Auth Log trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore Auth Log',
        'success' => 'Auth Log restored successfully!',
        'error' => 'Auth Log restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Auth Log',
        'success' => 'Auth Log destroyed successfully!',
        'error' => 'Auth Log destroyed unsuccessfully!'
    ],
    //    'customAction' => [
    //        'title' => 'Auth Log custom action',
    //        'success' => 'Auth Log custom action completed successfully!',
    //        'redirect' => 'Auth Log custom action completed successfully!',
    //        'error' => 'Auth Log custom action completed unsuccessfully!',
    //    ],
    'fields' => [
		'date' => 'Date',
		'loggable_type' => 'Loggable Type',
		'loggable_id' => 'Loggable',
		'loggable' => [
			'name' => 'Loggable',
		],
    ],
    'placeholders' => [
		'loggable' => 'Select Loggable',
        'customer_user' => 'Select Customer User',
    ],
    'columns' => [
		'date' => 'Date',
		'loggable_type' => 'Loggable Type',
		'loggable_id' => 'Loggable',
		'loggable' => [
			'name' => 'Loggable',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'loggable' => [
			'name' => 'Loggable',
		],
        'loggable_type' => 'Loggable Type',
        'customer_user' => 'Customer User'
    ],
];
