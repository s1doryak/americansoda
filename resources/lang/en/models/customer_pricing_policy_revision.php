<?php

return [
    'labels' => [
        'singular' => 'CustomerPricingPolicyRevision',
        'plural' => 'CustomerPricingPolicyRevision',
		'create' => 'Create CustomerPricingPolicyRevision'
    ],
	'index' => [
		'title' => 'List of CustomerPricingPolicyRevision',
	],
    'trashed' => [
        'title' => 'List of trashed CustomerPricingPolicyRevision',
    ],
	'create' => [
		'title' => 'Create CustomerPricingPolicyRevision',
	],
    'store' => [
	    'success' => 'CustomerPricingPolicyRevision created successfully!',
	    'error' => 'CustomerPricingPolicyRevision created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerPricingPolicyRevision',
    ],
	'edit' => [
		'title' => 'Edit CustomerPricingPolicyRevision',
	],
	'update' => [
		'success' => 'CustomerPricingPolicyRevision updated successfully!',
		'error' => 'CustomerPricingPolicyRevision updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CustomerPricingPolicyRevision to trash',
		'success' => 'CustomerPricingPolicyRevision trashed successfully!',
		'error' => 'CustomerPricingPolicyRevision trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CustomerPricingPolicyRevision',
        'success' => 'CustomerPricingPolicyRevision restored successfully!',
        'error' => 'CustomerPricingPolicyRevision restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerPricingPolicyRevision',
        'success' => 'CustomerPricingPolicyRevision destroyed successfully!',
        'error' => 'CustomerPricingPolicyRevision destroyed unsuccessfully!'
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