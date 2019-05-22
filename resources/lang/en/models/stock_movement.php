<?php

return [
    'labels' => [
        'singular' => 'StockMovement',
        'plural' => 'StockMovement',
		'create' => 'Create StockMovement'
    ],
	'index' => [
		'title' => 'List of StockMovement',
	],
    'trashed' => [
        'title' => 'List of trashed StockMovement',
    ],
	'create' => [
		'title' => 'Create StockMovement',
	],
    'store' => [
	    'success' => 'StockMovement created successfully!',
	    'error' => 'StockMovement created unsuccessfully!'
    ],
    'show' => [
        'title' => 'StockMovement',
    ],
	'edit' => [
		'title' => 'Edit StockMovement',
	],
	'update' => [
		'success' => 'StockMovement updated successfully!',
		'error' => 'StockMovement updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move StockMovement to trash',
		'success' => 'StockMovement trashed successfully!',
		'error' => 'StockMovement trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore StockMovement',
        'success' => 'StockMovement restored successfully!',
        'error' => 'StockMovement restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy StockMovement',
        'success' => 'StockMovement destroyed successfully!',
        'error' => 'StockMovement destroyed unsuccessfully!'
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