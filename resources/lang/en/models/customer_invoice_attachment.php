<?php

return [
    'labels' => [
        'singular' => 'Customer Invoice Attachment',
        'plural' => 'Customer Invoice Attachments',
		'create' => 'Create Customer Invoice Attachment'
    ],
	'index' => [
		'title' => 'List of Customer Invoice Attachments',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Invoice Attachments',
    ],
	'create' => [
		'title' => 'Create Customer Invoice Attachment',
	],
    'store' => [
	    'success' => 'Customer Invoice Attachment created successfully!',
	    'error' => 'Customer Invoice Attachment created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Invoice Attachment',
    ],
	'edit' => [
		'title' => 'Edit Customer Invoice Attachment',
	],
	'update' => [
		'success' => 'Customer Invoice Attachment updated successfully!',
		'error' => 'Customer Invoice Attachment updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer Invoice Attachment to trash',
		'success' => 'Customer Invoice Attachment trashed successfully!',
		'error' => 'Customer Invoice Attachment trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer Invoice Attachment',
        'success' => 'Customer Invoice Attachment restored successfully!',
        'error' => 'Customer Invoice Attachment restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Invoice Attachment',
        'success' => 'Customer Invoice Attachment destroyed successfully!',
        'error' => 'Customer Invoice Attachment destroyed unsuccessfully!'
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
