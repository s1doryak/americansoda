<?php

return [
    'labels' => [
        'singular' => 'Product Tag',
        'plural' => 'Product Tags',
		'create' => 'Create Product Tag'
    ],
	'index' => [
		'title' => 'List of Product Tags',
	],
    'trashed' => [
        'title' => 'List of trashed Product Tags',
    ],
	'create' => [
		'title' => 'Create Product Tag',
	],
    'store' => [
	    'success' => 'Product Tag created successfully!',
	    'error' => 'Product Tag created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Product Tag',
    ],
	'edit' => [
		'title' => 'Edit Product Tag',
	],
	'update' => [
		'success' => 'Product Tag updated successfully!',
		'error' => 'Product Tag updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Product Tag to trash',
		'success' => 'Product Tag trashed successfully!',
		'error' => 'Product Tag trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Product Tag',
        'success' => 'Product Tag restored successfully!',
        'error' => 'Product Tag restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Product Tag',
        'success' => 'Product Tag destroyed successfully!',
        'error' => 'Product Tag destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',
		'icon' => 'Icon',
		'color' => 'Color',
		'products' => [
			'name' => 'Products',
		],
	],
    'placeholders' => [
		'products' => 'Select Products',
    ],
    'columns' => [
		'name' => 'Name',
		'icon' => 'Icon',
		'color' => 'Color',
		'products' => [
			'name' => 'Products',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'products' => [
			'name' => 'Products',
		],
    ],
];
