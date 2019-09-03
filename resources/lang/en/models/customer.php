<?php

return [
    'labels' => [
        'singular' => 'Customer',
        'plural' => 'Customer',
		'create' => 'Create Customer'
    ],
	'index' => [
		'title' => 'List of Customer',
	],
    'trashed' => [
        'title' => 'List of trashed Customer',
    ],
	'create' => [
		'title' => 'Create Customer',
	],
    'store' => [
	    'success' => 'Customer created successfully!',
	    'error' => 'Customer created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer',
    ],
	'edit' => [
		'title' => 'Edit Customer',
	],
	'update' => [
		'success' => 'Customer updated successfully!',
		'error' => 'Customer updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Customer to trash',
		'success' => 'Customer trashed successfully!',
		'error' => 'Customer trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Customer',
        'success' => 'Customer restored successfully!',
        'error' => 'Customer restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer',
        'success' => 'Customer destroyed successfully!',
        'error' => 'Customer destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',
		'legal_name' => 'Legal Name',
		'billing_postcode' => 'Billing Postcode',
		'billing_address' => 'Billing Address',
		'shipping_postcode' => 'Shipping Postcode',
		'shipping_address' => 'Shipping Address',
		'iban' => 'IBAN',
		'swift' => 'Swift',
		'email' => 'Email',
		'phone' => 'Phone',
		'order_interval' => 'Order Interval',
		'comment' => 'Comment',
		'calendar_comment' => 'Calendar Comment',
		'incomterms' => [
			'name' => 'Incomterms',
		],
		'terms_of_cooperation' => 'Terms Of Cooperation',
		'terms_of_delivery' => 'Terms Of Delivery',
		'terms_of_equipment' => 'Terms Of Equipment',
		'delivery_payer' => [
			'name' => 'Delivery Payer',
		],
		'payment_conditions' => 'Payment Conditions',
		'pays_vat' => 'Pays Vat',
		'archived' => 'Archived',
		'nr' => 'Nr',
		'country' => 'Country',
		'state' => 'State',
		'post_code' => 'Post Code',
		'post_office' => 'Post Office',
		'address1' => 'Address1',
		'address2' => 'Address2',
		'contact_p' => 'Contact P',
        'y_tunnus' => 'Y-Tunnus',
        'bid' => 'BID',
        'ovt' => 'OVT',
		'priceGroup' => [
			'name' => 'Price Group',
		],
		'stock' => [
			'name' => 'Stock',
		],
		'customerType' => [
			'name' => 'Customer Type',
		],
		'paymentType' => [
			'name' => 'Payment Type',
		],
		'user' => [
			'name' => 'User',
		],
		'billingRegion' => [
			'name' => 'Billing Region',
		],
		'shippingRegion' => [
			'name' => 'Shipping Region',
		],
	],
    'placeholders' => [
		'stock' => 'Select Stock',
		'customerType' => 'Select Customer Type',
		'paymentType' => 'Select Payment Type',
		'user' => 'Select User',
		'billingRegion' => 'Select Billing Region',
		'shippingRegion' => 'Select Shipping Region',
		'priceGroup' => 'Select Price Group',
		'customerInvoices' => 'Select Customer Invoices',
    ],
    'columns' => [
		'name' => 'Name',
		'legal_name' => 'Legal Name',
		'billing_postcode' => 'Billing Postcode',
		'billing_address' => 'Billing Address',
		'shipping_postcode' => 'Shipping Postcode',
		'shipping_address' => 'Shipping Address',
		'iban' => 'Iban',
		'swift' => 'Swift',
		'email' => 'Email',
		'phone' => 'Phone',
		'order_interval' => 'Order Interval',
		'comment' => 'Comment',
		'calendar_comment' => 'Calendar Comment',
		'incomterms' => 'Incomterms',
		'terms_of_cooperation' => 'Terms Of Cooperation',
		'terms_of_delivery' => 'Terms Of Delivery',
		'terms_of_equipment' => 'Terms Of Equipment',
		'delivery_payer' => 'Delivery Payer',
		'payment_conditions' => 'Payment Conditions',
		'pays_vat' => 'Pays Vat',
		'archived' => 'Archived',
		'nr' => 'Nr',
		'country' => 'Country',
		'state' => 'State',
		'post_code' => 'Post Code',
		'post_office' => 'Post Office',
		'address1' => 'Address1',
		'address2' => 'Address2',
		'contact_p' => 'Contact P',
        'y_tunnus' => 'Y-Tunnus',
        'bid' => 'BID',
		'ovt' => 'OVT',
		'priceGroup' => [
			'name' => 'Price Group',
		],
		'stock' => [
			'name' => 'Stock',
		],
		'customerType' => [
			'name' => 'Customer Type',
		],
		'paymentType' => [
			'name' => 'Payment Type',
		],
		'user' => [
			'name' => 'User',
		],
		'billingRegion' => [
			'name' => 'Billing Region',
		],
		'shippingRegion' => [
			'name' => 'Shipping Region',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'priceGroup' => [
			'name' => 'Price Group',
		],
		'stock' => [
			'name' => 'Stock',
		],
		'customerType' => [
			'name' => 'Customer Type',
		],
		'paymentType' => [
			'name' => 'Payment Type',
		],
		'user' => [
			'name' => 'User',
		],
		'billingRegion' => [
			'name' => 'Billing Region',
		],
		'shippingRegion' => [
			'name' => 'Shipping Region',
		],
    ],
    'requirements' => [
        'nr' => 'You need to setup customer number first.'
    ]
];
