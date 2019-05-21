<?php

return [
    'labels' => [
        'singular' => 'Company',
        'plural' => 'Company',
		'create' => 'Create Company'
    ],
	'index' => [
		'title' => 'List of Company',
	],
    'trashed' => [
        'title' => 'List of trashed Company',
    ],
	'create' => [
		'title' => 'Create Company',
	],
    'store' => [
	    'success' => 'Company created successfully!',
	    'error' => 'Company created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Company',
    ],
	'edit' => [
		'title' => 'Edit Company',
	],
	'update' => [
		'success' => 'Company updated successfully!',
		'error' => 'Company updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Company to trash',
		'success' => 'Company trashed successfully!',
		'error' => 'Company trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Company',
        'success' => 'Company restored successfully!',
        'error' => 'Company restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Company',
        'success' => 'Company destroyed successfully!',
        'error' => 'Company destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',
		'legal_name' => 'Legal Name',
		'short_name' => 'Short Name',
		'postcode' => 'Postcode',
		'address' => 'Address',
		'bid' => 'Bid',
		'email' => 'Email',
		'phone' => 'Phone',
		'code' => 'Code',
		'smtp_host' => 'Smtp Host',
		'smtp_port' => 'Smtp Port',
		'smtp_encryption' => 'Smtp Encryption',
		'smtp_username' => 'Smtp Username',
		'smtp_password' => 'Smtp Password',
		'smtp_from' => 'Smtp From',
		'smtp_from_name' => 'Smtp From Name',
		'region' => [
			'name' => 'Region',
		],
	],
    'placeholders' => [
		'region' => 'Select Region',
    ],
    'columns' => [
		'name' => 'Name',
		'legal_name' => 'Legal Name',
		'short_name' => 'Short Name',
		'postcode' => 'Postcode',
		'address' => 'Address',
		'bid' => 'Bid',
		'email' => 'Email',
		'phone' => 'Phone',
		'code' => 'Code',
		'smtp_host' => 'Smtp Host',
		'smtp_port' => 'Smtp Port',
		'smtp_encryption' => 'Smtp Encryption',
		'smtp_username' => 'Smtp Username',
		'smtp_password' => 'Smtp Password',
		'smtp_from' => 'Smtp From',
		'smtp_from_name' => 'Smtp From Name',
		'region' => [
			'name' => 'Region',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'region' => [
			'name' => 'Region',
		],
    ],
];