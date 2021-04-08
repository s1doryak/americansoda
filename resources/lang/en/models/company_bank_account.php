<?php

return [
    'labels' => [
        'singular' => 'Company Bank Account',
        'plural' => 'Company Bank Accounts',
		'create' => 'Create Company Bank Account'
    ],
	'index' => [
		'title' => 'Company Bank Accounts',
	],
    'trashed' => [
        'title' => 'Trashed Company Bank Accounts',
    ],
	'create' => [
		'title' => 'Create Company Bank Account',
	],
    'store' => [
	    'success' => 'Company Bank Account created successfully!',
	    'error' => 'Company Bank Account created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Company Bank Account',
    ],
	'edit' => [
		'title' => 'Edit Company Bank Account',
	],
	'update' => [
		'success' => 'Company Bank Account updated successfully!',
		'error' => 'Company Bank Account updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Company Bank Account to trash',
		'success' => 'Company Bank Account trashed successfully!',
		'error' => 'Company Bank Account trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Company Bank Account',
        'success' => 'Company Bank Account restored successfully!',
        'error' => 'Company Bank Account restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Company Bank Account',
        'success' => 'Company Bank Account destroyed successfully!',
        'error' => 'Company Bank Account destroyed unsuccessfully!'
    ],
	'fields' => [
		'bank' => 'Bank',
		'swift' => 'Swift',
		'account' => 'Account',
		'iban' => 'Iban',
		'default' => 'Default',
		'company' => [
			'name' => 'Company',
		],
	],
    'placeholders' => [
		'company' => 'Select Company',
    ],
    'columns' => [
		'bank' => 'Bank',
		'swift' => 'Swift',
		'account' => 'Account',
		'iban' => 'Iban',
		'default' => 'Default',
		'company' => [
			'name' => 'Company',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'company' => [
			'name' => 'Company',
		],
    ],
];
