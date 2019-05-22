<?php

return [
    'labels' => [
        'singular' => 'CustomerShipment',
        'plural' => 'CustomerShipment',
		'create' => 'Create CustomerShipment'
    ],
	'index' => [
		'title' => 'List of CustomerShipment',
	],
    'trashed' => [
        'title' => 'List of trashed CustomerShipment',
    ],
	'create' => [
		'title' => 'Create CustomerShipment',
	],
    'store' => [
	    'success' => 'CustomerShipment created successfully!',
	    'error' => 'CustomerShipment created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerShipment',
    ],
	'edit' => [
		'title' => 'Edit CustomerShipment',
	],
	'update' => [
		'success' => 'CustomerShipment updated successfully!',
		'error' => 'CustomerShipment updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CustomerShipment to trash',
		'success' => 'CustomerShipment trashed successfully!',
		'error' => 'CustomerShipment trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CustomerShipment',
        'success' => 'CustomerShipment restored successfully!',
        'error' => 'CustomerShipment restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerShipment',
        'success' => 'CustomerShipment destroyed successfully!',
        'error' => 'CustomerShipment destroyed unsuccessfully!'
    ],
	'fields' => [
		'number' => 'Number',
		'assembly_number' => 'Assembly Number',
		'invoice_number' => 'Invoice Number',
		'status' => 'Status',
		'delivery_type' => 'Delivery Type',
		'packages_quantity' => 'Packages Quantity',
		'comment' => 'Comment',
		'packageType' => [
			'name' => 'Package Type',
		],
		'customer' => [
			'name' => 'Customer',
		],
		'user' => [
			'name' => 'User',
		],
	],
    'placeholders' => [
		'packageType' => 'Select Package Type',
		'customer' => 'Select Customer',
		'user' => 'Select User',
    ],
    'columns' => [
		'number' => 'Number',
		'assembly_number' => 'Assembly Number',
		'invoice_number' => 'Invoice Number',
		'status' => 'Status',
		'delivery_type' => 'Delivery Type',
		'packages_quantity' => 'Packages Quantity',
		'comment' => 'Comment',
		'packageType' => [
			'name' => 'Package Type',
		],
		'customer' => [
			'name' => 'Customer',
		],
		'user' => [
			'name' => 'User',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'packageType' => [
			'name' => 'Package Type',
		],
		'customer' => [
			'name' => 'Customer',
		],
		'user' => [
			'name' => 'User',
		],
    ],
];