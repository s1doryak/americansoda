<?php

return [
    'labels' => [
        'singular' => 'Failed Job',
        'plural' => 'Failed Job',
        'create' => 'Create Failed Job'
    ],
    'index' => [
        'title' => 'Failed Jobs',
    ],
    'trashed' => [
        'title' => 'Trashed Failed Jobs',
    ],
    'create' => [
        'title' => 'Create Failed Job',
    ],
    'store' => [
        'success' => 'Failed Job created successfully!',
        'error' => 'Failed Job created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Failed Job',
    ],
    'edit' => [
        'title' => 'Edit Failed Job',
    ],
    'update' => [
        'success' => 'Failed Job updated successfully!',
        'error' => 'Failed Job updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move Failed Job to trash',
        'success' => 'Failed Job trashed successfully!',
        'error' => 'Failed Job trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore Failed Job',
        'success' => 'Failed Job restored successfully!',
        'error' => 'Failed Job restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Failed Job',
        'success' => 'Failed Job destroyed successfully!',
        'error' => 'Failed Job destroyed unsuccessfully!'
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
