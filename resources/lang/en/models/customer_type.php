<?php

return [
    'labels' => [
        'singular' => 'CustomerType',
        'plural' => 'CustomerType',
		'create' => 'Create CustomerType'
    ],
	'index' => [
		'title' => 'List of CustomerType',
	],
    'trashed' => [
        'title' => 'List of trashed CustomerType',
    ],
	'create' => [
		'title' => 'Create CustomerType',
	],
    'store' => [
	    'success' => 'CustomerType created successfully!',
	    'error' => 'CustomerType created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerType',
    ],
	'edit' => [
		'title' => 'Edit CustomerType',
	],
	'update' => [
		'success' => 'CustomerType updated successfully!',
		'error' => 'CustomerType updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CustomerType to trash',
		'success' => 'CustomerType trashed successfully!',
		'error' => 'CustomerType trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CustomerType',
        'success' => 'CustomerType restored successfully!',
        'error' => 'CustomerType restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerType',
        'success' => 'CustomerType destroyed successfully!',
        'error' => 'CustomerType destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',
		'customerType' => [
			'name' => 'Customer Type',
		],
	],
    'placeholders' => [
		'customerType' => 'Select Customer Type',
    ],
    'columns' => [
		'name' => 'Name',
		'customerType' => [
			'name' => 'Customer Type',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customerType' => [
			'name' => 'Customer Type',
		],
    ],
];