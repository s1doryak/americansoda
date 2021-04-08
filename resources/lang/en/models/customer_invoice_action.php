<?php

return [
    'labels' => [
        'singular' => 'Customer Invoice Action',
        'plural' => 'Customer Invoice Actions',
		'create' => 'Create Customer Invoice Action'
    ],
	'index' => [
		'title' => 'Customer Invoice Actions',
	],
    'trashed' => [
        'title' => 'Trashed Customer Invoice Actions',
    ],
	'create' => [
		'title' => 'Create Customer Invoice Action',
	],
    'store' => [
	    'success' => 'Customer Invoice Action created successfully!',
	    'error' => 'Customer Invoice Action created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Invoice Action',
    ],
	'edit' => [
		'title' => 'Edit Customer Invoice Action',
	],
	'update' => [
		'success' => 'Customer Invoice Action updated successfully!',
		'error' => 'Customer Invoice Action updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer Invoice Action to trash',
		'success' => 'Customer Invoice Action trashed successfully!',
		'error' => 'Customer Invoice Action trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer Invoice Action',
        'success' => 'Customer Invoice Action restored successfully!',
        'error' => 'Customer Invoice Action restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Invoice Action',
        'success' => 'Customer Invoice Action destroyed successfully!',
        'error' => 'Customer Invoice Action destroyed unsuccessfully!'
    ],
	'fields' => [
		'action' => 'Action',
		'timestamp' => 'Timestamp',
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
	],
    'placeholders' => [
		'customerInvoice' => 'Select Customer Invoice',
    ],
    'columns' => [
		'action' => 'Action',
		'timestamp' => 'Timestamp',
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
    ],
];
