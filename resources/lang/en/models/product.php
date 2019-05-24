<?php

return [
    'labels' => [
        'singular' => 'Product',
        'plural' => 'Product',
		'create' => 'Create Product'
    ],
	'index' => [
		'title' => 'List of Product',
	],
    'trashed' => [
        'title' => 'List of trashed Product',
    ],
	'create' => [
		'title' => 'Create Product',
	],
    'store' => [
	    'success' => 'Product created successfully!',
	    'error' => 'Product created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Product',
    ],
	'edit' => [
		'title' => 'Edit Product',
	],
	'update' => [
		'success' => 'Product updated successfully!',
		'error' => 'Product updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Product to trash',
		'success' => 'Product trashed successfully!',
		'error' => 'Product trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Product',
        'success' => 'Product restored successfully!',
        'error' => 'Product restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Product',
        'success' => 'Product destroyed successfully!',
        'error' => 'Product destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',
		'product_barcode' => 'Product Barcode',
		'product_barcode_plaintext' => 'Product Barcode Plaintext',
		'package_barcode' => 'Package Barcode',
		'package_barcode_plaintext' => 'Package Barcode Plaintext',
		'product_image' => 'Product Image',
		'package_image' => 'Package Image',
		'description' => 'Description',
		'contents' => 'Contents',
		'number_in_package' => 'Number In Package',
		'weight' => 'Weight',
		'volume' => 'Volume',
		'brutto_weight' => 'Brutto Weight',
		'brutto_volume' => 'Brutto Volume',
		'deposit_enabled' => 'Deposit Enabled',
		'deposit_price' => 'Deposit Price',
		'deposit_vat' => 'Deposit Vat',
		'deposit_vat_price' => 'Deposit Vat Price',
		'comment' => 'Comment',
		'brand' => [
			'name' => 'Brand',
		],
		'packageType' => [
			'name' => 'Package Type',
		],
		'productGroup' => [
			'name' => 'Product Group',
		],
		'productTags' => [
			'name' => 'Product Tags',
		],
	],
    'placeholders' => [
		'brand' => 'Select Brand',
		'packageType' => 'Select Package Type',
		'productGroup' => 'Select Product Group',
		'productTags' => 'Select Tags',
    ],
    'columns' => [
		'name' => 'Name',
		'product_barcode' => 'Product Barcode',
		'product_barcode_plaintext' => 'Product Barcode Plaintext',
		'package_barcode' => 'Package Barcode',
		'package_barcode_plaintext' => 'Package Barcode Plaintext',
		'product_image' => 'Product Image',
		'package_image' => 'Package Image',
		'description' => 'Description',
		'contents' => 'Contents',
		'number_in_package' => 'Number In Package',
		'weight' => 'Weight',
		'volume' => 'Volume',
		'brutto_weight' => 'Brutto Weight',
		'brutto_volume' => 'Brutto Volume',
		'deposit_enabled' => 'Deposit Enabled',
		'deposit_price' => 'Deposit Price',
		'deposit_vat' => 'Deposit Vat',
		'deposit_vat_price' => 'Deposit Vat Price',
		'comment' => 'Comment',
		'brand' => [
			'name' => 'Brand',
		],
		'packageType' => [
			'name' => 'Package Type',
		],
		'productGroup' => [
			'name' => 'Product Group',
		],
		'productGroups' => [
			'name' => 'Product Tags',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'brand' => [
			'name' => 'Brand',
		],
		'packageType' => [
			'name' => 'Package Type',
		],
		'productTags' => [
			'name' => 'Product Group',
		],
    ],
];