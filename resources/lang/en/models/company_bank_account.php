<?php

return [
    'labels' => [
        'singular' => 'CompanyBankAccount',
        'plural' => 'Company Bank Accounts',
		'create' => 'Create CompanyBankAccount'
    ],
	'index' => [
		'title' => 'List of Company Bank Accounts',
	],
    'trashed' => [
        'title' => 'List of trashed Company Bank Accounts',
    ],
	'create' => [
		'title' => 'Create CompanyBankAccount',
	],
    'store' => [
	    'success' => 'CompanyBankAccount created successfully!',
	    'error' => 'CompanyBankAccount created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CompanyBankAccount',
    ],
	'edit' => [
		'title' => 'Edit CompanyBankAccount',
	],
	'update' => [
		'success' => 'CompanyBankAccount updated successfully!',
		'error' => 'CompanyBankAccount updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CompanyBankAccount to trash',
		'success' => 'CompanyBankAccount trashed successfully!',
		'error' => 'CompanyBankAccount trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CompanyBankAccount',
        'success' => 'CompanyBankAccount restored successfully!',
        'error' => 'CompanyBankAccount restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CompanyBankAccount',
        'success' => 'CompanyBankAccount destroyed successfully!',
        'error' => 'CompanyBankAccount destroyed unsuccessfully!'
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