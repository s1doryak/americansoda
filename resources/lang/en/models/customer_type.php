<?php

return [
    'labels' => [
        'singular' => 'Customer Type',
        'plural' => 'Customer Type',
		'create' => 'Create Customer Type'
    ],
	'index' => [
		'title' => 'Customer Types',
	],
    'trashed' => [
        'title' => 'Trashed Customer Types',
    ],
	'create' => [
		'title' => 'Create Customer Type',
	],
    'store' => [
	    'success' => 'Customer Type created successfully!',
	    'error' => 'Customer Type created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Type',
    ],
	'edit' => [
		'title' => 'Edit Customer Type',
	],
	'update' => [
		'success' => 'Customer Type updated successfully!',
		'error' => 'Customer Type updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer Type to trash',
		'success' => 'Customer Type trashed successfully!',
		'error' => 'Customer Type trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer Type',
        'success' => 'Customer Type restored successfully!',
        'error' => 'Customer Type restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Type',
        'success' => 'Customer Type destroyed successfully!',
        'error' => 'Customer Type destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',
		'customerType' => [
			'name' => 'Parent',
		],
	],
    'placeholders' => [
		'customerType' => 'Select Parent',
    ],
    'columns' => [
		'name' => 'Name',
		'customerType' => [
			'name' => 'Parent',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customerType' => [
			'name' => 'Parent',
		],
    ],
];
