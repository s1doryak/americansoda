<?php

return [
    'labels' => [
        'singular' => 'Customer User',
        'plural' => 'Customer Users',
		'create' => 'Create Customer User'
    ],
    'login' => [
        'title' => 'Login as Customer User',
    ],
	'index' => [
		'title' => 'List of Customer Users',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Users',
    ],
	'create' => [
		'title' => 'Create Customer User',
	],
    'store' => [
	    'success' => 'Customer User created successfully!',
	    'error' => 'Customer User created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer User',
    ],
	'edit' => [
		'title' => 'Edit Customer User',
	],
	'update' => [
		'success' => 'Customer User updated successfully!',
		'error' => 'Customer User updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer User to trash',
		'success' => 'Customer User trashed successfully!',
		'error' => 'Customer User trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer User',
        'success' => 'Customer User restored successfully!',
        'error' => 'Customer User restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer User',
        'success' => 'Customer User destroyed successfully!',
        'error' => 'Customer User destroyed unsuccessfully!'
    ],
	'fields' => [
		'email' => 'Email',
		'email_verified_at' => 'Email Verified At',
		'password' => 'Password',
		'name' => '',
		'phone' => 'Phone',
		'comment' => 'Comment',
		'customers' => [
			'name' => 'Customers',
		],
		'customerUserTokens' => [

		],
	],
    'placeholders' => [
		'customers' => 'Select Customers',
		'customerUserTokens' => 'Select Customer User Tokens',
    ],
    'columns' => [
		'email' => 'Email',
		'email_verified_at' => 'Email Verified At',
		'password' => 'Password',
		'name' => '',
		'phone' => 'Phone',
		'comment' => 'Comment',
		'customers' => [
			'name' => 'Customers',
		],
		'customerUserTokens' => [

		],
        'loggable' => 'Last Visit',
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customers' => [
			'name' => 'Customers',
		],
		'customerUserTokens' => [

		],
    ],
];
