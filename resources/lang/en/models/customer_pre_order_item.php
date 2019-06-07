<?php

return [
    'labels' => [
        'singular' => 'Customer Pre Order Item',
        'plural' => 'Customer Pre Order Items',
		'create' => 'Create Customer Pre Order Item'
    ],
	'index' => [
		'title' => 'List of Customer Pre Order Items',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Pre Order Items',
    ],
	'create' => [
		'title' => 'Create Customer Pre Order Item',
	],
    'store' => [
	    'success' => 'Customer Pre Order Item created successfully!',
	    'error' => 'Customer Pre Order Item created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Pre Order Item',
    ],
	'edit' => [
		'title' => 'Edit Customer Pre Order Item',
	],
	'update' => [
		'success' => 'Customer Pre Order Item updated successfully!',
		'error' => 'Customer Pre Order Item updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer Pre Order Item to trash',
		'success' => 'Customer Pre Order Item trashed successfully!',
		'error' => 'Customer Pre Order Item trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer Pre Order Item',
        'success' => 'Customer Pre Order Item restored successfully!',
        'error' => 'Customer Pre Order Item restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Pre Order Item',
        'success' => 'Customer Pre Order Item destroyed successfully!',
        'error' => 'Customer Pre Order Item destroyed unsuccessfully!'
    ],
	'fields' => [
		'quantity' => 'Quantity',
		'products_quantity' => 'Products Quantity',
		'price' => 'Price',
		'vat_price' => 'Vat Price',
		'total_price' => 'Total Price',
		'total_vat_price' => 'Total Vat Price',
		'deposit_price' => 'Deposit Price',
		'deposit_vat_price' => 'Deposit Vat Price',
		'total_deposit_price' => 'Total Deposit Price',
		'total_deposit_vat_price' => 'Total Deposit Vat Price',
		'customerPreOrder' => [
			'number' => 'Number',
		],
		'customerUser' => [
			'name' => 'Customer User',
		],
		'customer' => [
			'name' => 'Customer',
		],
		'product' => [
			'name' => 'Product',
		],
	],
    'placeholders' => [
		'customerPreOrder' => 'Select Number',
		'customerUser' => 'Select Customer User',
		'customer' => 'Select Customer',
		'product' => 'Select Product',
    ],
    'columns' => [
		'quantity' => 'Quantity',
		'products_quantity' => 'Products Quantity',
		'price' => 'Price',
		'vat_price' => 'Vat Price',
		'total_price' => 'Total Price',
		'total_vat_price' => 'Total Vat Price',
		'deposit_price' => 'Deposit Price',
		'deposit_vat_price' => 'Deposit Vat Price',
		'total_deposit_price' => 'Total Deposit Price',
		'total_deposit_vat_price' => 'Total Deposit Vat Price',
		'customerPreOrder' => [
			'number' => 'Number',
		],
		'customerUser' => [
			'name' => 'Customer User',
		],
		'customer' => [
			'name' => 'Customer',
		],
		'product' => [
			'name' => 'Product',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customerPreOrder' => [
			'number' => 'Number',
		],
		'customerUser' => [
			'name' => 'Customer User',
		],
		'customer' => [
			'name' => 'Customer',
		],
		'product' => [
			'name' => 'Product',
		],
    ],
];