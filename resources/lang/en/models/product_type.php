<?php

return [
    'labels' => [
        'singular' => 'Product Type',
        'plural' => 'Product Types',
		'create' => 'Create Product Type'
    ],
	'index' => [
		'title' => 'List of Product Types',
	],
    'trashed' => [
        'title' => 'List of trashed Product Types',
    ],
	'create' => [
		'title' => 'Create Product Type',
	],
    'store' => [
	    'success' => 'Product Type created successfully!',
	    'error' => 'Product Type created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Product Type',
    ],
	'edit' => [
		'title' => 'Edit Product Type',
	],
	'update' => [
		'success' => 'Product Type updated successfully!',
		'error' => 'Product Type updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Product Type to trash',
		'success' => 'Product Type trashed successfully!',
		'error' => 'Product Type trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Product Type',
        'success' => 'Product Type restored successfully!',
        'error' => 'Product Type restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Product Type',
        'success' => 'Product Type destroyed successfully!',
        'error' => 'Product Type destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => '',
		'productGroups' => [

		],
	],
    'placeholders' => [
		'productGroups' => 'Select %s',
    ],
    'columns' => [
		'name' => '',
		'productGroups' => [

		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'productGroups' => [

		],
    ],
];