<?php

return [
    'labels' => [
        'singular' => 'User',
        'plural' => 'User',
		'create' => 'Create User'
    ],
	'index' => [
		'title' => 'List of User',
	],
    'trashed' => [
        'title' => 'List of trashed User',
    ],
	'create' => [
		'title' => 'Create User',
	],
    'store' => [
	    'success' => 'User created successfully!',
	    'error' => 'User created unsuccessfully!'
    ],
    'show' => [
        'title' => 'User',
    ],
	'edit' => [
		'title' => 'Edit User',
	],
	'update' => [
		'success' => 'User updated successfully!',
		'error' => 'User updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move User to trash',
		'success' => 'User trashed successfully!',
		'error' => 'User trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore User',
        'success' => 'User restored successfully!',
        'error' => 'User restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy User',
        'success' => 'User destroyed successfully!',
        'error' => 'User destroyed unsuccessfully!'
    ],
	'fields' => [
		'email' => 'Email',
		'email_verified_at' => 'Email Verified At',
		'password' => 'Password',
		'email' => 'Email',
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
