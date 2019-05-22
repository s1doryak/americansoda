<?php

return [
    'labels' => [
        'singular' => 'Stock',
        'plural' => 'Stock',
		'create' => 'Create Stock'
    ],
	'index' => [
		'title' => 'List of Stock',
	],
    'trashed' => [
        'title' => 'List of trashed Stock',
    ],
	'create' => [
		'title' => 'Create Stock',
	],
    'store' => [
	    'success' => 'Stock created successfully!',
	    'error' => 'Stock created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Stock',
    ],
	'edit' => [
		'title' => 'Edit Stock',
	],
	'update' => [
		'success' => 'Stock updated successfully!',
		'error' => 'Stock updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Stock to trash',
		'success' => 'Stock trashed successfully!',
		'error' => 'Stock trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Stock',
        'success' => 'Stock restored successfully!',
        'error' => 'Stock restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Stock',
        'success' => 'Stock destroyed successfully!',
        'error' => 'Stock destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',
		'postcode' => 'Postcode',
		'address' => 'Address',
		'region' => [
			'name' => 'Region',
		],
	],
    'placeholders' => [
		'region' => 'Select Region',
    ],
    'columns' => [
		'name' => 'Name',
		'postcode' => 'Postcode',
		'address' => 'Address',
		'region' => [
			'name' => 'Region',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'region' => [
			'name' => 'Region',
		],
    ],
];