<?php

return [
    'labels' => [
        'singular' => 'Customer Pre Order',
        'plural' => 'Customer Pre Orders',
		'create' => 'Create Customer Pre Order'
    ],
	'index' => [
		'title' => 'List of Customer Pre Orders',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Pre Orders',
    ],
	'create' => [
		'title' => 'Create Customer Pre Order',
	],
    'store' => [
	    'success' => 'Customer Pre Order created successfully!',
	    'error' => 'Customer Pre Order created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Pre Order',
    ],
	'edit' => [
		'title' => 'Edit Customer Pre Order',
	],
	'update' => [
		'success' => 'Customer Pre Order updated successfully!',
		'error' => 'Customer Pre Order updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer Pre Order to trash',
		'success' => 'Customer Pre Order trashed successfully!',
		'error' => 'Customer Pre Order trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer Pre Order',
        'success' => 'Customer Pre Order restored successfully!',
        'error' => 'Customer Pre Order restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Pre Order',
        'success' => 'Customer Pre Order destroyed successfully!',
        'error' => 'Customer Pre Order destroyed unsuccessfully!'
    ],
	'fields' => [
		'number' => 'Number',
		'reference_number' => 'Reference Number',
		'comment' => 'Comment',
		'customerUser' => [
			'name' => 'Customer User',
		],
		'customerOrder' => [
			'number' => 'Number',
		],
		'customer' => [
            'name' => 'Customer'
		],
		'items' => [
            'name' => 'Items'
		],
	],
    'placeholders' => [
		'customerUser' => 'Select Customer User',
		'customerOrder' => 'Select Number',
		'customer' => 'Select Customer',
		'items' => 'Select Items',
    ],
    'columns' => [
		'number' => 'Number',
		'reference_number' => 'Reference Number',
		'comment' => 'Comment',
		'customerUser' => [
			'name' => 'Customer User',
		],
		'customerOrder' => [
			'number' => 'Number',
		],
		'customer' => [
            'name' => 'Customer'
		],
		'items' => [
            'name' => 'Items'
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customerUser' => [
			'name' => 'Customer User',
		],
		'customerOrder' => [
			'number' => 'Number',
		],
		'customer' => [
            'name' => 'Customer'
		],
		'items' => [
            'name' => 'Items'
		],
    ],
];