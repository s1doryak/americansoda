<?php

return [
    'labels' => [
        'singular' => 'PaymentType',
        'plural' => 'PaymentType',
		'create' => 'Create PaymentType'
    ],
	'index' => [
		'title' => 'List of PaymentType',
	],
    'trashed' => [
        'title' => 'List of trashed PaymentType',
    ],
	'create' => [
		'title' => 'Create PaymentType',
	],
    'store' => [
	    'success' => 'PaymentType created successfully!',
	    'error' => 'PaymentType created unsuccessfully!'
    ],
    'show' => [
        'title' => 'PaymentType',
    ],
	'edit' => [
		'title' => 'Edit PaymentType',
	],
	'update' => [
		'success' => 'PaymentType updated successfully!',
		'error' => 'PaymentType updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move PaymentType to trash',
		'success' => 'PaymentType trashed successfully!',
		'error' => 'PaymentType trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore PaymentType',
        'success' => 'PaymentType restored successfully!',
        'error' => 'PaymentType restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy PaymentType',
        'success' => 'PaymentType destroyed successfully!',
        'error' => 'PaymentType destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',

	],
    'placeholders' => [

    ],
    'columns' => [
		'name' => 'Name',

        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [

    ],
];