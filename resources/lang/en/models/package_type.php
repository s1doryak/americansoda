<?php

return [
    'labels' => [
        'singular' => 'PackageType',
        'plural' => 'PackageType',
		'create' => 'Create PackageType'
    ],
	'index' => [
		'title' => 'List of PackageType',
	],
    'trashed' => [
        'title' => 'List of trashed PackageType',
    ],
	'create' => [
		'title' => 'Create PackageType',
	],
    'store' => [
	    'success' => 'PackageType created successfully!',
	    'error' => 'PackageType created unsuccessfully!'
    ],
    'show' => [
        'title' => 'PackageType',
    ],
	'edit' => [
		'title' => 'Edit PackageType',
	],
	'update' => [
		'success' => 'PackageType updated successfully!',
		'error' => 'PackageType updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move PackageType to trash',
		'success' => 'PackageType trashed successfully!',
		'error' => 'PackageType trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore PackageType',
        'success' => 'PackageType restored successfully!',
        'error' => 'PackageType restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy PackageType',
        'success' => 'PackageType destroyed successfully!',
        'error' => 'PackageType destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',
		'description' => 'Description',

	],
    'placeholders' => [

    ],
    'columns' => [
		'name' => 'Name',
		'description' => 'Description',

        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [

    ],
];