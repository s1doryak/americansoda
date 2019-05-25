<?php

return [
    'labels' => [
        'singular' => 'StockMovementProduct',
        'plural' => 'StockMovementProduct',
		'create' => 'Create StockMovementProduct'
    ],
	'index' => [
		'title' => 'List of StockMovementProduct',
	],
    'trashed' => [
        'title' => 'List of trashed StockMovementProduct',
    ],
	'create' => [
		'title' => 'Create StockMovementProduct',
	],
    'store' => [
	    'success' => 'StockMovementProduct created successfully!',
	    'error' => 'StockMovementProduct created unsuccessfully!'
    ],
    'show' => [
        'title' => 'StockMovementProduct',
    ],
	'edit' => [
		'title' => 'Edit StockMovementProduct',
	],
	'update' => [
		'success' => 'StockMovementProduct updated successfully!',
		'error' => 'StockMovementProduct updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move StockMovementProduct to trash',
		'success' => 'StockMovementProduct trashed successfully!',
		'error' => 'StockMovementProduct trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore StockMovementProduct',
        'success' => 'StockMovementProduct restored successfully!',
        'error' => 'StockMovementProduct restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy StockMovementProduct',
        'success' => 'StockMovementProduct destroyed successfully!',
        'error' => 'StockMovementProduct destroyed unsuccessfully!'
    ],
	'fields' => [
		'product_name' => 'Product Name',
		'products_quantity' => 'Products Quantity',
		'delivery_number' => 'Delivery Number',
		'expiration_date' => 'Expiration Date',
		'movement_type' => 'Movement Type',
		'comment' => 'Comment',
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
