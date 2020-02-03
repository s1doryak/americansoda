<?php

return [
    'labels' => [
        'singular' => 'Customer Invoice Item',
        'plural' => 'Customer Invoice Items',
		'create' => 'Create Customer Invoice Item'
    ],
	'index' => [
		'title' => 'List of Customer Invoice Items',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Invoice Items',
    ],
	'create' => [
		'title' => 'Create Customer Invoice Item',
	],
    'store' => [
	    'success' => 'Customer Invoice Item created successfully!',
	    'error' => 'Customer Invoice Item created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Invoice Item',
    ],
	'edit' => [
		'title' => 'Edit Customer Invoice Item',
	],
	'update' => [
		'success' => 'Customer Invoice Item updated successfully!',
		'error' => 'Customer Invoice Item updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer Invoice Item to trash',
		'success' => 'Customer Invoice Item trashed successfully!',
		'error' => 'Customer Invoice Item trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer Invoice Item',
        'success' => 'Customer Invoice Item restored successfully!',
        'error' => 'Customer Invoice Item restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Invoice Item',
        'success' => 'Customer Invoice Item destroyed successfully!',
        'error' => 'Customer Invoice Item destroyed unsuccessfully!'
    ],
	'fields' => [
		'position' => 'Position',
		'item_code' => 'Item Code',
		'subject' => 'Subject',
		'definition' => 'Definition',
		'price' => 'Price',
		'unit_type' => 'Unit Type',
		'amount' => 'Amount',
		'sum' => 'Sum',
		'tax' => 'Tax',
		'sum_tax' => 'Sum Tax',
		'discount' => 'Discount',
		'customerInvoice' => [
			'name' => 'Invoice',
		],
		'customerOrderItem' => [
			'name' => 'Order Item',
		],
        'product' => [
            'name' => 'Product',
        ],
    ],
    'placeholders' => [
		'customerInvoice' => 'Select Invoice',
		'customerOrderItem' => 'Select Order Item',
        'product' => 'Select Product',
    ],
    'columns' => [
		'position' => 'Position',
		'item_code' => 'Item Code',
		'subject' => 'Subject',
		'definition' => 'Definition',
		'price' => 'Price',
		'unit_type' => 'Unit Type',
		'amount' => 'Amount',
		'sum' => 'Sum',
		'tax' => 'Tax',
		'sum_tax' => 'Sum Tax',
		'discount' => 'Discount',
		'customerInvoice' => [
			'name' => 'Invoice',
		],
		'customerOrderItem' => [
			'name' => 'Order Item',
		],
        'product' => [
            'name' => 'Product',
        ],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customerInvoice' => [
			'name' => 'Invoice',
		],
		'customerOrderItem' => [
			'name' => 'Order Item',
		],
        'product' => [
            'name' => 'Product',
        ],
    ],
];
