<?php

return [
    'labels' => [
        'singular' => 'Customer User Subscribe',
        'plural' => 'Customer User Subscribes',
        'create' => 'Create Customer User Subscribe'
    ],
    'index' => [
        'title' => 'List of Customer User Subscribes',
    ],
    'trashed' => [
        'title' => 'List of trashed Customer User Subscribes',
    ],
    'create' => [
        'title' => 'Create Customer User Subscribe',
    ],
    'store' => [
        'success' => 'Customer User Subscribe created successfully!',
        'error' => 'Customer User Subscribe created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer User Subscribe',
    ],
    'edit' => [
        'title' => 'Edit Customer User Subscribe',
    ],
    'update' => [
        'success' => 'Customer User Subscribe updated successfully!',
        'error' => 'Customer User Subscribe updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move Customer User Subscribe to trash',
        'success' => 'Customer User Subscribe trashed successfully!',
        'error' => 'Customer User Subscribe trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore Customer User Subscribe',
        'success' => 'Customer User Subscribe restored successfully!',
        'error' => 'Customer User Subscribe restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer User Subscribe',
        'success' => 'Customer User Subscribe destroyed successfully!',
        'error' => 'Customer User Subscribe destroyed unsuccessfully!'
    ],
    //    'customAction' => [
    //        'title' => 'Customer User Subscribe custom action',
    //        'success' => 'Customer User Subscribe custom action completed successfully!',
    //        'redirect' => 'Customer User Subscribe custom action completed successfully!',
    //        'error' => 'Customer User Subscribe custom action completed unsuccessfully!',
    //    ],
    'fields' => [

		'product' => [
			'name' => 'Product',
		],
		'customerUser' => [
			'name' => 'Customer User',
		],
    ],
    'placeholders' => [
		'product' => 'Select Product',
		'customerUser' => 'Select Customer User',
    ],
    'columns' => [

		'product' => [
			'name' => 'Product',
		],
		'customerUser' => [
			'name' => 'Customer User',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'product' => [
			'name' => 'Product',
		],
		'customerUser' => [
			'name' => 'Customer User',
		],
    ],
];
