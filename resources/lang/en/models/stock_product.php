<?php

return [
    'labels' => [
        'singular' => 'Stock',
        'plural' => 'Stock',
		'create' => 'Create Stock'
    ],
	'index' => [
		'title' => 'List of Stock',
	],
    'trashed' => [
        'title' => 'List of trashed Stock',
    ],
	'create' => [
		'title' => 'Create Stock',
	],
    'store' => [
	    'success' => 'Stock created successfully!',
	    'error' => 'Stock created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Stock',
    ],
	'edit' => [
		'title' => 'Edit Stock',
	],
	'update' => [
		'success' => 'Stock updated successfully!',
		'error' => 'Stock updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Stock to trash',
		'success' => 'Stock trashed successfully!',
		'error' => 'Stock trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Stock',
        'success' => 'Stock restored successfully!',
        'error' => 'Stock restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Stock',
        'success' => 'Stock destroyed successfully!',
        'error' => 'Stock destroyed unsuccessfully!'
    ],
	'fields' => [
		'delivery_number' => 'Delivery Number',
		'expiration_date' => 'Expiration Date',
		'stock' => [
			'name' => 'Stock',
		],
		'product' => [
			'name' => 'Product',
		],
		'customerOrderItem' => [
			'name' => 'Customer Order Item',
		],
	],
    'placeholders' => [
		'stock' => 'Select Stock',
		'product' => 'Select Product',
		'customerOrderItem' => 'Select Customer Order Item',
    ],
    'columns' => [
        'stock' => [
            'name' => 'Stock',
        ],
        'product' => [
            'name' => 'Product',
            'productGroup' => [
                'name' => 'Group'
            ]
        ],
        'delivery_number' => 'L-number',
        'expiration_date' => 'BBD',
        'total' => 'Total',
        'reserved' => 'Reserved',
        'available' => 'Available',
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
        'stock' => [
            'name' => 'Stock',
        ],
        'product' => [
            'name' => 'Product',
            'productGroup' => [
                'name' => 'Group'
            ]
        ],
        'delivery_number' => 'L-number',
    ],
];
