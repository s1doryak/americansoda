<?php

return [
    'labels' => [
        'singular' => 'ProductTag',
        'plural' => 'Product Tags',
		'create' => 'Create ProductTag'
    ],
	'index' => [
		'title' => 'List of Product Tags',
	],
    'trashed' => [
        'title' => 'List of trashed Product Tags',
    ],
	'create' => [
		'title' => 'Create ProductTag',
	],
    'store' => [
	    'success' => 'ProductTag created successfully!',
	    'error' => 'ProductTag created unsuccessfully!'
    ],
    'show' => [
        'title' => 'ProductTag',
    ],
	'edit' => [
		'title' => 'Edit ProductTag',
	],
	'update' => [
		'success' => 'ProductTag updated successfully!',
		'error' => 'ProductTag updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move ProductTag to trash',
		'success' => 'ProductTag trashed successfully!',
		'error' => 'ProductTag trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore ProductTag',
        'success' => 'ProductTag restored successfully!',
        'error' => 'ProductTag restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy ProductTag',
        'success' => 'ProductTag destroyed successfully!',
        'error' => 'ProductTag destroyed unsuccessfully!'
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