<?php

return [
    'labels' => [
        'singular' => 'CustomerPricingPolicy',
        'plural' => 'CustomerPricingPolicy',
		'create' => 'Create CustomerPricingPolicy'
    ],
	'index' => [
		'title' => 'List of CustomerPricingPolicy',
	],
    'trashed' => [
        'title' => 'List of trashed CustomerPricingPolicy',
    ],
	'create' => [
		'title' => 'Create CustomerPricingPolicy',
	],
    'store' => [
	    'success' => 'CustomerPricingPolicy created successfully!',
	    'error' => 'CustomerPricingPolicy created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerPricingPolicy',
    ],
	'edit' => [
		'title' => 'Edit CustomerPricingPolicy',
	],
	'update' => [
		'success' => 'CustomerPricingPolicy updated successfully!',
		'error' => 'CustomerPricingPolicy updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CustomerPricingPolicy to trash',
		'success' => 'CustomerPricingPolicy trashed successfully!',
		'error' => 'CustomerPricingPolicy trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CustomerPricingPolicy',
        'success' => 'CustomerPricingPolicy restored successfully!',
        'error' => 'CustomerPricingPolicy restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerPricingPolicy',
        'success' => 'CustomerPricingPolicy destroyed successfully!',
        'error' => 'CustomerPricingPolicy destroyed unsuccessfully!'
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