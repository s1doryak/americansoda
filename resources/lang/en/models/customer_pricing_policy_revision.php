<?php

return [
    'labels' => [
        'singular' => 'Customer Pricing Policy Revision',
        'plural' => 'Customer Pricing Policy Revision',
		'create' => 'Create Customer Pricing Policy Revision'
    ],
	'index' => [
		'title' => 'List of Customer Pricing Policy Revision',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Pricing Policy Revision',
    ],
	'create' => [
		'title' => 'Create Customer Pricing Policy Revision',
	],
    'store' => [
	    'success' => 'Customer Pricing Policy Revision created successfully!',
	    'error' => 'Customer Pricing Policy Revision created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Pricing Policy Revision',
    ],
	'edit' => [
		'title' => 'Edit Customer Pricing Policy Revision',
	],
	'update' => [
		'success' => 'Customer Pricing Policy Revision updated successfully!',
		'error' => 'Customer Pricing Policy Revision updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer Pricing Policy Revision to trash',
		'success' => 'Customer Pricing Policy Revision trashed successfully!',
		'error' => 'Customer Pricing Policy Revision trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer Pricing Policy Revision',
        'success' => 'Customer Pricing Policy Revision restored successfully!',
        'error' => 'Customer Pricing Policy Revision restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Pricing Policy Revision',
        'success' => 'Customer Pricing Policy Revision destroyed successfully!',
        'error' => 'Customer Pricing Policy Revision destroyed unsuccessfully!'
    ],
	'fields' => [
		'revision_type' => 'Revision Type',
		'revision_number' => 'Revision Number',
		'products_range' => 'Products Range',
		'price' => 'Price',
		'revision' => [
			'name' => 'Revision',
		],
		'customerPricingPolicy' => [
			'name' => 'Customer Pricing Policy',
		],
		'editor' => [
			'name' => 'Editor',
		],
		'productGroup' => [
			'name' => 'Product Group',
		],
		'customer' => [
			'name' => 'Customer',
		],
	],
    'placeholders' => [
		'revision' => 'Select Revision',
		'customerPricingPolicy' => 'Select Customer Pricing Policy',
		'editor' => 'Select Editor',
		'productGroup' => 'Select Product Group',
		'customer' => 'Select Customer',
    ],
    'columns' => [
		'revision_type' => 'Revision Type',
		'revision_number' => 'Revision Number',
		'products_range' => 'Products Range',
		'price' => 'Price',
		'revision' => [
			'name' => 'Revision',
		],
		'customerPricingPolicy' => [
			'name' => 'Customer Pricing Policy',
		],
		'editor' => [
			'name' => 'Editor',
		],
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
		'revision' => [
			'name' => 'Revision',
		],
		'customerPricingPolicy' => [
			'name' => 'Customer Pricing Policy',
		],
		'editor' => [
			'name' => 'Editor',
		],
		'productGroup' => [
			'name' => 'Product Group',
		],
		'customer' => [
			'name' => 'Customer',
		],
    ],
];
