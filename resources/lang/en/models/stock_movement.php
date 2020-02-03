<?php

return [
    'labels' => [
        'singular' => 'Stock Movement',
        'plural' => 'Stock Movement',
		'create' => 'Create Stock Movement'
    ],
	'index' => [
		'title' => 'List of Stock Movement',
	],
    'trashed' => [
        'title' => 'List of trashed Stock Movement',
    ],
	'create' => [
		'title' => 'Create Stock Movement',
	],
    'store' => [
	    'success' => 'Stock Movement created successfully!',
	    'error' => 'Stock Movement created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Stock Movement',
    ],
	'edit' => [
		'title' => 'Edit Stock Movement',
	],
	'update' => [
		'success' => 'Stock Movement updated successfully!',
		'error' => 'Stock Movement updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Stock Movement to trash',
		'success' => 'Stock Movement trashed successfully!',
		'error' => 'Stock Movement trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Stock Movement',
        'success' => 'Stock Movement restored successfully!',
        'error' => 'Stock Movement restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Stock Movement',
        'success' => 'Stock Movement destroyed successfully!',
        'error' => 'Stock Movement destroyed unsuccessfully!'
    ],
	'fields' => [
		'movement_type' => 'Movement Type',
		'stock' => [
			'name' => 'Stock',
		],
	],
    'placeholders' => [
		'stock' => 'Select Stock',
    ],
    'columns' => [
		'movement_type' => 'Movement Type',
		'stock' => [
			'name' => 'Stock',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'stock' => [
			'name' => 'Stock',
		],
    ],
];
