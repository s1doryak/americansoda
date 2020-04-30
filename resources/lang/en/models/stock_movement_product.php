<?php

return [
    'labels' => [
        'singular' => 'Movement',
        'plural' => 'Movement',
		'create' => 'Create Movement'
    ],
	'index' => [
		'title' => 'List of Movement',
	],
    'trashed' => [
        'title' => 'List of trashed Movement',
    ],
	'create' => [
		'title' => 'Create Movement',
	],
    'store' => [
	    'success' => 'Movement created successfully!',
	    'error' => 'Movement created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Movement',
    ],
	'edit' => [
		'title' => 'Edit Movement',
	],
	'update' => [
		'success' => 'Movement updated successfully!',
		'error' => 'Movement updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Movement to trash',
		'success' => 'Movement trashed successfully!',
		'error' => 'Movement trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Movement',
        'success' => 'Movement restored successfully!',
        'error' => 'Movement restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Movement',
        'success' => 'Movement destroyed successfully!',
        'error' => 'Movement destroyed unsuccessfully!'
    ],
	'fields' => [
		'product_name' => 'Product Name',
		'products_quantity' => 'Products Quantity',
		'delivery_number' => 'Delivery Number',
		'expiration_date' => 'Expiration Date',
		'comment' => 'Comment',
        'movement_type' => [
            'name' => 'Movement Type'
        ],
        'stockMovement' => [
			'name' => 'Stock Movement',
		],
		'product' => [
			'name' => 'Product',
		],
	],
    'placeholders' => [
		'stockMovement' => 'Select Stock Movement',
		'product' => 'Select Product',
    ],
    'columns' => [
		'product_name' => 'Product Name',
		'products_quantity' => 'Products Quantity',
		'delivery_number' => 'Delivery Number',
		'expiration_date' => 'Expiration Date',
		'movement_type' => 'Movement Type',
		'comment' => 'Comment',
        'formatted_products_quantity' => 'Quantity',
        'stockMovement' => [
            'stock' => [
                'name' => 'Stock',
            ],
        ],
		'product' => [
			'name' => 'Product',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
        'stockMovement' => [
            'stock' => [
                'name' => 'Stock',
            ],
        ],
        'product' => [
            'name' => 'Product',
        ],
        'created_at' => 'Registered',
        'comment' => 'Comment (DD.MM.YYYY)'
    ],
];
