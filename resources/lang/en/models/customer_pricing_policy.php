<?php

return [
    'labels' => [
        'singular' => 'Customer Pricing Policy',
        'plural' => 'Customer Pricing Policy',
		'create' => 'Create Customer Pricing Policy'
    ],
	'index' => [
		'title' => 'List of Customer Pricing Policy',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Pricing Policy',
    ],
	'create' => [
		'title' => 'Create Customer Pricing Policy',
	],
    'store' => [
	    'success' => 'Customer Pricing Policy created successfully!',
	    'error' => 'Customer Pricing Policy created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Pricing Policy',
    ],
	'edit' => [
		'title' => 'Edit Customer Pricing Policy',
	],
	'update' => [
		'success' => 'Customer Pricing Policy updated successfully!',
		'error' => 'Customer Pricing Policy updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer Pricing Policy to trash',
		'success' => 'Customer Pricing Policy trashed successfully!',
		'error' => 'Customer Pricing Policy trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer Pricing Policy',
        'success' => 'Customer Pricing Policy restored successfully!',
        'error' => 'Customer Pricing Policy restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Pricing Policy',
        'success' => 'Customer Pricing Policy destroyed successfully!',
        'error' => 'Customer Pricing Policy destroyed unsuccessfully!'
    ],
	'fields' => [
		'products_range' => 'Products Range',
		'price' => 'Price',
		'productGroup' => [
			'name' => 'Product Group',
		],
		'customer' => [
			'name' => 'Customer',
		],
	],
    'placeholders' => [
		'productGroup' => 'Select Product Group',
		'customer' => 'Select Customer',
    ],
    'columns' => [
		'products_range' => 'Products Range',
		'price' => 'Price',
		'productGroup' => [
			'name' => 'Product Group',
		],
		'customer' => [
			'name' => 'Customer',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'productGroup' => [
			'name' => 'Product Group',
		],
		'customer' => [
			'name' => 'Customer',
		],
    ],
];
