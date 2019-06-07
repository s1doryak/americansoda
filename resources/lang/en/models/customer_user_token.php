<?php

return [
    'labels' => [
        'singular' => 'Customer User Token',
        'plural' => 'Customer User Tokens',
		'create' => 'Create Customer User Token'
    ],
	'index' => [
		'title' => 'List of Customer User Tokens',
	],
    'trashed' => [
        'title' => 'List of trashed Customer User Tokens',
    ],
	'create' => [
		'title' => 'Create Customer User Token',
	],
    'store' => [
	    'success' => 'Customer User Token created successfully!',
	    'error' => 'Customer User Token created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer User Token',
    ],
	'edit' => [
		'title' => 'Edit Customer User Token',
	],
	'update' => [
		'success' => 'Customer User Token updated successfully!',
		'error' => 'Customer User Token updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer User Token to trash',
		'success' => 'Customer User Token trashed successfully!',
		'error' => 'Customer User Token trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer User Token',
        'success' => 'Customer User Token restored successfully!',
        'error' => 'Customer User Token restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer User Token',
        'success' => 'Customer User Token destroyed successfully!',
        'error' => 'Customer User Token destroyed unsuccessfully!'
    ],
	'fields' => [
		'token' => 'Token',
		'ip_address' => 'Ip Address',
		'user_agent' => 'User Agent',
		'customerUser' => [
			'name' => 'Customer User',
		],
	],
    'placeholders' => [
		'customerUser' => 'Select Customer User',
    ],
    'columns' => [
		'token' => 'Token',
		'ip_address' => 'Ip Address',
		'user_agent' => 'User Agent',
		'customerUser' => [
			'name' => 'Customer User',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customerUser' => [
			'name' => 'Customer User',
		],
    ],
];