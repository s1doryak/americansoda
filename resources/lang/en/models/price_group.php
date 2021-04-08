<?php

return [
    'labels' => [
        'singular' => 'Price Group',
        'plural' => 'Price Groups',
		'create' => 'Create Price Group'
    ],
	'index' => [
		'title' => 'Price Groups',
	],
    'trashed' => [
        'title' => 'Trashed Price Groups',
    ],
	'create' => [
		'title' => 'Create Price Group',
	],
    'store' => [
	    'success' => 'Price Group created successfully!',
	    'error' => 'Price Group created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Price Group',
    ],
	'edit' => [
		'title' => 'Edit Price Group',
	],
	'update' => [
		'success' => 'Price Group updated successfully!',
		'error' => 'Price Group updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Price Group to trash',
		'success' => 'Price Group trashed successfully!',
		'error' => 'Price Group trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Price Group',
        'success' => 'Price Group restored successfully!',
        'error' => 'Price Group restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Price Group',
        'success' => 'Price Group destroyed successfully!',
        'error' => 'Price Group destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => '',
		'manual' => 'Manual',
		'customers' => [

		],
		'priceGroupBreakpoints' => [

		],
	],
    'placeholders' => [
		'customers' => 'Select Customers',
		'priceGroupBreakpoints' => 'Select Price Group Breakpoints',
    ],
    'columns' => [
		'name' => '',
		'manual' => 'Manual',
		'customers' => [

		],
		'priceGroupBreakpoints' => [

		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customers' => [

		],
		'priceGroupBreakpoints' => [

		],
    ],
];
