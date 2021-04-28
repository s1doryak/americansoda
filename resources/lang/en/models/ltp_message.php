<?php

return [
    'labels' => [
        'singular' => 'LTP Message',
        'plural' => 'LTP Messages',
        'create' => 'Create LTP Message'
    ],
    'index' => [
        'title' => 'List of LTP Messages',
    ],
    'trashed' => [
        'title' => 'List of trashed LTP Messages',
    ],
    'create' => [
        'title' => 'Create LTP Message',
    ],
    'store' => [
        'success' => 'LTP Message created successfully!',
        'error' => 'LTP Message created unsuccessfully!'
    ],
    'show' => [
        'title' => 'LTP Message',
    ],
    'edit' => [
        'title' => 'Edit LTP Message',
    ],
    'update' => [
        'success' => 'LTP Message updated successfully!',
        'error' => 'LTP Message updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move LTP Message to trash',
        'success' => 'LTP Message trashed successfully!',
        'error' => 'LTP Message trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore LTP Message',
        'success' => 'LTP Message restored successfully!',
        'error' => 'LTP Message restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy LTP Message',
        'success' => 'LTP Message destroyed successfully!',
        'error' => 'LTP Message destroyed unsuccessfully!'
    ],
    //    'customAction' => [
    //        'title' => 'LTP Message custom action',
    //        'success' => 'LTP Message custom action completed successfully!',
    //        'redirect' => 'LTP Message custom action completed successfully!',
    //        'error' => 'LTP Message custom action completed unsuccessfully!',
    //    ],
    'fields' => [
		'sender_identifier' => 'Senderentifier',
		'sender_description' => 'Sender Description',
		'filename_hint' => 'Filename Hint',
		'content' => 'Content',

    ],
    'placeholders' => [

    ],
    'columns' => [
		'sender_identifier' => 'Sender Identifier',
		'sender_description' => 'Sender Description',
		'filename_hint' => 'Filename Hint',
		'content' => 'Content',

        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [

    ],
];
