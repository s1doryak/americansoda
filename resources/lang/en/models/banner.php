<?php

return [
    'labels' => [
        'singular' => 'Banner',
        'plural' => 'Banners',
		'create' => 'Create Banner'
    ],
	'index' => [
		'title' => 'Banners',
	],
    'trashed' => [
        'title' => 'Trashed Banners',
    ],
	'create' => [
		'title' => 'Create Banner',
	],
    'store' => [
	    'success' => 'Banner created successfully!',
	    'error' => 'Banner created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Banner',
    ],
	'edit' => [
		'title' => 'Edit Banner',
	],
	'update' => [
		'success' => 'Banner updated successfully!',
		'error' => 'Banner updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Banner to trash',
		'success' => 'Banner trashed successfully!',
		'error' => 'Banner trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Banner',
        'success' => 'Banner restored successfully!',
        'error' => 'Banner restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Banner',
        'success' => 'Banner destroyed successfully!',
        'error' => 'Banner destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => '',
		'image' => 'Image',
		'url' => 'Url',
		'customerTypes' => [
			'name' => 'Customer Types',
		],
	],
    'placeholders' => [
		'customerTypes' => 'Select %s',
    ],
    'columns' => [
		'name' => '',
		'image' => 'Image',
		'url' => 'Url',
		'customerTypes' => [
			'name' => 'Customer Types',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customerTypes' => [
			'name' => 'Customer Types',
		],
    ],
];
