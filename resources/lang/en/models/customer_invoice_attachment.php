<?php

return [
    'labels' => [
        'singular' => 'CustomerInvoiceAttachment',
        'plural' => 'Customer Invoice Attachments',
		'create' => 'Create CustomerInvoiceAttachment'
    ],
	'index' => [
		'title' => 'List of Customer Invoice Attachments',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Invoice Attachments',
    ],
	'create' => [
		'title' => 'Create CustomerInvoiceAttachment',
	],
    'store' => [
	    'success' => 'CustomerInvoiceAttachment created successfully!',
	    'error' => 'CustomerInvoiceAttachment created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerInvoiceAttachment',
    ],
	'edit' => [
		'title' => 'Edit CustomerInvoiceAttachment',
	],
	'update' => [
		'success' => 'CustomerInvoiceAttachment updated successfully!',
		'error' => 'CustomerInvoiceAttachment updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CustomerInvoiceAttachment to trash',
		'success' => 'CustomerInvoiceAttachment trashed successfully!',
		'error' => 'CustomerInvoiceAttachment trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CustomerInvoiceAttachment',
        'success' => 'CustomerInvoiceAttachment restored successfully!',
        'error' => 'CustomerInvoiceAttachment restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerInvoiceAttachment',
        'success' => 'CustomerInvoiceAttachment destroyed successfully!',
        'error' => 'CustomerInvoiceAttachment destroyed unsuccessfully!'
    ],
	'fields' => [
		'attachment_type' => 'Attachment Type',
		'filename' => 'Filename',
		'file' => 'File',
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
	],
    'placeholders' => [
		'customerInvoice' => 'Select Customer Invoice',
    ],
    'columns' => [
		'attachment_type' => 'Attachment Type',
		'filename' => 'Filename',
		'file' => 'File',
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