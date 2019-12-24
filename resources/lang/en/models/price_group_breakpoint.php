<?php

return [
    'labels' => [
        'singular' => 'Price Group Breakpoint',
        'plural' => 'Price Group Breakpoints',
		'create' => 'Create Price Group Breakpoint'
    ],
	'index' => [
		'title' => 'List of Price Group Breakpoints',
	],
    'trashed' => [
        'title' => 'List of trashed Price Group Breakpoints',
    ],
	'create' => [
		'title' => 'Create Price Group Breakpoint',
	],
    'store' => [
	    'success' => 'Price Group Breakpoint created successfully!',
	    'error' => 'Price Group Breakpoint created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Price Group Breakpoint',
    ],
	'edit' => [
		'title' => 'Edit Price Group Breakpoint',
	],
	'update' => [
		'success' => 'Price Group Breakpoint updated successfully!',
		'error' => 'Price Group Breakpoint updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Price Group Breakpoint to trash',
		'success' => 'Price Group Breakpoint trashed successfully!',
		'error' => 'Price Group Breakpoint trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Price Group Breakpoint',
        'success' => 'Price Group Breakpoint restored successfully!',
        'error' => 'Price Group Breakpoint restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Price Group Breakpoint',
        'success' => 'Price Group Breakpoint destroyed successfully!',
        'error' => 'Price Group Breakpoint destroyed unsuccessfully!'
    ],
	'fields' => [
		'breakpoint' => 'Breakpoint',
		'priceGroup' => [
			'name' => 'Price Group',
		],
		'productGroups' => [
			'name' => 'Product Groups / Price',
			'price' => 'Price',
		],
	],
    'placeholders' => [
		'priceGroup' => 'Select Price Group',
		'productGroups' => 'Select Product Groups',
    ],
    'columns' => [
		'breakpoint' => 'Breakpoint',
		'priceGroup' => [
			'name' => 'Price Group',
		],
		'productGroups' => [
			'name' => 'Product Groups / Price',
			'price' => 'Price',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'priceGroup' => [
			'name' => 'Price Group',
		],
		'productGroups' => [
			'name' => 'Product Groups',
			'price' => 'Price',
		],
    ],
];
