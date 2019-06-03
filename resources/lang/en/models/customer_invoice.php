<?php

return [
    'labels' => [
        'singular' => 'CustomerInvoice',
        'plural' => 'Customer Invoices',
		'create' => 'Create CustomerInvoice'
    ],
	'index' => [
		'title' => 'List of Customer Invoices',
	],
    'trashed' => [
        'title' => 'List of trashed Customer Invoices',
    ],
	'create' => [
		'title' => 'Create CustomerInvoice',
	],
    'store' => [
	    'success' => 'CustomerInvoice created successfully!',
	    'error' => 'CustomerInvoice created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerInvoice',
    ],
	'edit' => [
		'title' => 'Edit CustomerInvoice',
	],
	'update' => [
		'success' => 'CustomerInvoice updated successfully!',
		'error' => 'CustomerInvoice updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CustomerInvoice to trash',
		'success' => 'CustomerInvoice trashed successfully!',
		'error' => 'CustomerInvoice trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CustomerInvoice',
        'success' => 'CustomerInvoice restored successfully!',
        'error' => 'CustomerInvoice restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerInvoice',
        'success' => 'CustomerInvoice destroyed successfully!',
        'error' => 'CustomerInvoice destroyed unsuccessfully!'
    ],
	'fields' => [
		'maventa_id' => 'Maventa',
		'maventa_tiff' => 'Maventa Tiff',
		'maventa_initiated' => 'Maventa Initiated',
		'currency' => 'Currency',
		'data' => 'Data',
		'date' => 'Date',
		'date_due' => 'Date Due',
		'delivery_date' => 'Delivery Date',
		'delivery_type' => 'Delivery Type',
		'error_message' => 'Error Message',
		'invoice_delivery_address' => 'Invoice Delivery Address',
		'invoice_nr' => 'Invoice Nr',
		'invoice_seller_information' => 'Invoice Seller Information',
		'lang' => 'Lang',
		'notes' => 'Notes',
		'order_nr' => 'Order Nr',
		'payment_terms' => 'Payment Terms',
		'reference_nr' => 'Reference Nr',
		'state' => 'State',
		'status' => 'Status',
		'sum' => 'Sum',
		'sum_tax' => 'Sum Tax',
		'work_order_nr' => 'Work Order Nr',
		'company_interest' => 'Company Interest',
		'company_paper_fee' => 'Company Paper Fee',
		'company_reminder' => 'Company Reminder',
		'company_comment' => 'Company Comment',
		'company_reference' => 'Company Reference',
		'customer_nr' => 'Customer Nr',
		'customer_email' => 'Customer Email',
		'customer_name' => 'Customer Name',
		'customer_country' => 'Customer Country',
		'customer_state' => 'Customer State',
		'customer_post_code' => 'Customer Post Code',
		'customer_post_office' => 'Customer Post Office',
		'customer_address1' => 'Customer Address1',
		'customer_address2' => 'Customer Address2',
		'customer_contact_p' => 'Customer Contact P',
		'customer_bid' => 'Customer Bid',
		'customer_ovt' => 'Customer Ovt',
		'customer' => [
			'name' => 'Customer',
		],
		'shipment' => [
			'name' => 'Shipment',
		],
		'accounts' => [
			'name' => 'Accounts',
		],
		'items' => [
			'name' => 'Items',
		],
		'actions' => [
			'name' => 'Actions',
		],
		'attachments' => [
			'name' => 'Attachments',
		],
		'orderItems' => [
			'name' => 'Order Items',
		],
	],
    'placeholders' => [
		'customer' => 'Select Customer',
		'shipment' => 'Select Shipment',
		'accounts' => 'Select Accounts',
		'items' => 'Select Items',
		'actions' => 'Select Actions',
		'attachments' => 'Select Attachments',
		'orderItems' => 'Select Order Items',
    ],
    'columns' => [
		'maventa_id' => 'Maventa',
		'maventa_tiff' => 'Maventa Tiff',
		'maventa_initiated' => 'Maventa Initiated',
		'currency' => 'Currency',
		'data' => 'Data',
		'date' => 'Date',
		'date_due' => 'Date Due',
		'delivery_date' => 'Delivery Date',
		'delivery_type' => 'Delivery Type',
		'error_message' => 'Error Message',
		'invoice_delivery_address' => 'Invoice Delivery Address',
		'invoice_nr' => 'Invoice Nr',
		'invoice_seller_information' => 'Invoice Seller Information',
		'lang' => 'Lang',
		'notes' => 'Notes',
		'order_nr' => 'Order Nr',
		'payment_terms' => 'Payment Terms',
		'reference_nr' => 'Reference Nr',
		'state' => 'State',
		'status' => 'Status',
		'sum' => 'Sum',
		'sum_tax' => 'Sum Tax',
		'work_order_nr' => 'Work Order Nr',
		'company_interest' => 'Company Interest',
		'company_paper_fee' => 'Company Paper Fee',
		'company_reminder' => 'Company Reminder',
		'company_comment' => 'Company Comment',
		'company_reference' => 'Company Reference',
		'customer_nr' => 'Customer Nr',
		'customer_email' => 'Customer Email',
		'customer_name' => 'Customer Name',
		'customer_country' => 'Customer Country',
		'customer_state' => 'Customer State',
		'customer_post_code' => 'Customer Post Code',
		'customer_post_office' => 'Customer Post Office',
		'customer_address1' => 'Customer Address1',
		'customer_address2' => 'Customer Address2',
		'customer_contact_p' => 'Customer Contact P',
		'customer_bid' => 'Customer Bid',
		'customer_ovt' => 'Customer Ovt',
		'customer' => [
			'name' => 'Customer',
		],
		'shipment' => [
			'name' => 'Shipment',
		],
		'accounts' => [
			'name' => 'Accounts',
		],
		'items' => [
			'name' => 'Items',
		],
		'actions' => [
			'name' => 'Actions',
		],
		'attachments' => [
			'name' => 'Attachments',
		],
		'orderItems' => [
			'name' => 'Order Items',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customer' => [
			'name' => 'Customer',
		],
		'shipment' => [
			'name' => 'Shipment',
		],
		'accounts' => [
			'name' => 'Accounts',
		],
		'items' => [
			'name' => 'Items',
		],
		'actions' => [
			'name' => 'Actions',
		],
		'attachments' => [
			'name' => 'Attachments',
		],
		'orderItems' => [
			'name' => 'Order Items',
		],
    ],
];