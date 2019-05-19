<?php

return [
    'labels' => [
        'singular' => 'FailedJob',
        'plural' => 'FailedJob',
        'create' => 'Create FailedJob'
    ],
    'index' => [
        'title' => 'List of FailedJob',
    ],
    'trashed' => [
        'title' => 'List of trashed FailedJob',
    ],
    'create' => [
        'title' => 'Create FailedJob',
    ],
    'store' => [
        'success' => 'FailedJob created successfully!',
        'error' => 'FailedJob created unsuccessfully!'
    ],
    'show' => [
        'title' => 'FailedJob',
    ],
    'edit' => [
        'title' => 'Edit FailedJob',
    ],
    'update' => [
        'success' => 'FailedJob updated successfully!',
        'error' => 'FailedJob updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move FailedJob to trash',
        'success' => 'FailedJob trashed successfully!',
        'error' => 'FailedJob trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore FailedJob',
        'success' => 'FailedJob restored successfully!',
        'error' => 'FailedJob restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy FailedJob',
        'success' => 'FailedJob destroyed successfully!',
        'error' => 'FailedJob destroyed unsuccessfully!'
    ],
    'fields' => [
        'connection' => 'Connection',
        'queue' => 'Queue',
        'payload' => 'Payload',
        'exception' => 'Exception',
        'failed_at' => 'Failed At',

    ],
    'placeholders' => [

    ],
    'columns' => [
        'connection' => 'Connection',
        'queue' => 'Queue',
        'payload' => 'Payload',
        'exception' => 'Exception',
        'failed_at' => 'Failed At',

        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [

    ],
    'formatting' => [
        'timestamp' => [
            'default' => '%s',
            'year' => '%s',
            'month' => '%s',
            'day' => 'Today at %s',
        ],
    ]
];
