<?php

return [
    'labels' => [
        'singular' => 'Administrator',
        'plural' => 'Administrator',
		'create' => 'Create Administrator'
    ],
	'index' => [
		'title' => 'List of Administrator',
	],
    'trashed' => [
        'title' => 'List of trashed Administrator',
    ],
	'create' => [
		'title' => 'Create Administrator',
	],
    'store' => [
	    'success' => 'Administrator created successfully!',
	    'error' => 'Administrator created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Administrator',
    ],
	'edit' => [
		'title' => 'Edit Administrator',
	],
	'update' => [
		'success' => 'Administrator updated successfully!',
		'error' => 'Administrator updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Administrator to trash',
		'success' => 'Administrator trashed successfully!',
		'error' => 'Administrator trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Administrator',
        'success' => 'Administrator restored successfully!',
        'error' => 'Administrator restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Administrator',
        'success' => 'Administrator destroyed successfully!',
        'error' => 'Administrator destroyed unsuccessfully!'
    ],
	'fields' => [
		'email' => 'Email',
		'email_verified_at' => 'Email Verified At',
		'password' => 'Password',
		'name' => 'Name',
		'phone' => 'Phone',
		'avatar' => 'Avatar',
		'role' => [
			'name' => 'Role',
		],
		'company' => [
			'name' => 'Company',
		],
	],
    'placeholders' => [
		'role' => 'Select Role',
		'company' => 'Select Company',
    ],
    'columns' => [
		'email' => 'Email',
		'email_verified_at' => 'Email Verified At',
		'password' => 'Password',
		'name' => 'Name',
		'phone' => 'Phone',
		'avatar' => 'Avatar',
		'role' => [
			'name' => 'Role',
		],
		'company' => [
			'name' => 'Company',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'role' => [
			'name' => 'Role',
		],
		'company' => [
			'name' => 'Company',
		],
    ],
];