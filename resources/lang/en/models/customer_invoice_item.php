<?php

return [
    'labels' => [
        'singular' => 'CustomerInvoiceItem',
        'plural' => 'Customer Invoice Items',
		'create' => 'Create CustomerInvoiceItem'
    ],
	'index' => [
		'title' => 'List of Customer Invoice Items',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Invoice Items',
    ],
	'create' => [
		'title' => 'Create CustomerInvoiceItem',
	],
    'store' => [
	    'success' => 'CustomerInvoiceItem created successfully!',
	    'error' => 'CustomerInvoiceItem created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerInvoiceItem',
    ],
	'edit' => [
		'title' => 'Edit CustomerInvoiceItem',
	],
	'update' => [
		'success' => 'CustomerInvoiceItem updated successfully!',
		'error' => 'CustomerInvoiceItem updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CustomerInvoiceItem to trash',
		'success' => 'CustomerInvoiceItem trashed successfully!',
		'error' => 'CustomerInvoiceItem trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CustomerInvoiceItem',
        'success' => 'CustomerInvoiceItem restored successfully!',
        'error' => 'CustomerInvoiceItem restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerInvoiceItem',
        'success' => 'CustomerInvoiceItem destroyed successfully!',
        'error' => 'CustomerInvoiceItem destroyed unsuccessfully!'
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
