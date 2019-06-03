<?php

return [
    'labels' => [
        'singular' => 'CustomerInvoiceAction',
        'plural' => 'Customer Invoice Actions',
		'create' => 'Create CustomerInvoiceAction'
    ],
	'index' => [
		'title' => 'List of Customer Invoice Actions',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Invoice Actions',
    ],
	'create' => [
		'title' => 'Create CustomerInvoiceAction',
	],
    'store' => [
	    'success' => 'CustomerInvoiceAction created successfully!',
	    'error' => 'CustomerInvoiceAction created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerInvoiceAction',
    ],
	'edit' => [
		'title' => 'Edit CustomerInvoiceAction',
	],
	'update' => [
		'success' => 'CustomerInvoiceAction updated successfully!',
		'error' => 'CustomerInvoiceAction updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CustomerInvoiceAction to trash',
		'success' => 'CustomerInvoiceAction trashed successfully!',
		'error' => 'CustomerInvoiceAction trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CustomerInvoiceAction',
        'success' => 'CustomerInvoiceAction restored successfully!',
        'error' => 'CustomerInvoiceAction restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerInvoiceAction',
        'success' => 'CustomerInvoiceAction destroyed successfully!',
        'error' => 'CustomerInvoiceAction destroyed unsuccessfully!'
    ],
	'fields' => [
		'action' => 'Action',
		'timestamp' => 'Timestamp',
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
	],
    'placeholders' => [
		'customerInvoice' => 'Select Customer Invoice',
    ],
    'columns' => [
		'action' => 'Action',
		'timestamp' => 'Timestamp',
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
    ],
];