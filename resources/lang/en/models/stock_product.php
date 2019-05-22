<?php

return [
    'labels' => [
        'singular' => 'StockProduct',
        'plural' => 'StockProduct',
		'create' => 'Create StockProduct'
    ],
	'index' => [
		'title' => 'List of StockProduct',
	],
    'trashed' => [
        'title' => 'List of trashed StockProduct',
    ],
	'create' => [
		'title' => 'Create StockProduct',
	],
    'store' => [
	    'success' => 'StockProduct created successfully!',
	    'error' => 'StockProduct created unsuccessfully!'
    ],
    'show' => [
        'title' => 'StockProduct',
    ],
	'edit' => [
		'title' => 'Edit StockProduct',
	],
	'update' => [
		'success' => 'StockProduct updated successfully!',
		'error' => 'StockProduct updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move StockProduct to trash',
		'success' => 'StockProduct trashed successfully!',
		'error' => 'StockProduct trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore StockProduct',
        'success' => 'StockProduct restored successfully!',
        'error' => 'StockProduct restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy StockProduct',
        'success' => 'StockProduct destroyed successfully!',
        'error' => 'StockProduct destroyed unsuccessfully!'
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
		],
		'customerOrderItem' => [
			'name' => 'Customer Order Item',
		],
    ],
];