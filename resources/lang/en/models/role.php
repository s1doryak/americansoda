<?php

return [
    'labels' => [
        'singular' => 'Role',
        'plural' => 'Role',
		'create' => 'Create Role'
    ],
	'index' => [
		'title' => 'Roles',
	],
    'trashed' => [
        'title' => 'Trashed Roles',
    ],
	'create' => [
		'title' => 'Create Role',
	],
    'store' => [
	    'success' => 'Role created successfully!',
	    'error' => 'Role created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Role',
    ],
	'edit' => [
		'title' => 'Edit Role',
	],
	'update' => [
		'success' => 'Role updated successfully!',
		'error' => 'Role updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move Role to trash',
		'success' => 'Role trashed successfully!',
		'error' => 'Role trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore Role',
        'success' => 'Role restored successfully!',
        'error' => 'Role restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Role',
        'success' => 'Role destroyed successfully!',
        'error' => 'Role destroyed unsuccessfully!'
    ],
	'fields' => [
		'name' => 'Name',
		'slug' => 'Slug',

	],
    'placeholders' => [

    ],
    'columns' => [
		'name' => 'Name',
		'slug' => 'Slug',

        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [

    ],
];
