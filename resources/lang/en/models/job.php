<?php

return [
    'labels' => [
        'singular' => 'Job',
        'plural' => 'Job',
        'create' => 'Create Job'
    ],
    'index' => [
        'title' => 'Jobs',
    ],
    'trashed' => [
        'title' => 'Trashed Jobs',
    ],
    'create' => [
        'title' => 'Create Job',
    ],
    'store' => [
        'success' => 'Job created successfully!',
        'error' => 'Job created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Job',
    ],
    'edit' => [
        'title' => 'Edit Job',
    ],
    'update' => [
        'success' => 'Job updated successfully!',
        'error' => 'Job updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move Job to trash',
        'success' => 'Job trashed successfully!',
        'error' => 'Job trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore Job',
        'success' => 'Job restored successfully!',
        'error' => 'Job restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Job',
        'success' => 'Job destroyed successfully!',
        'error' => 'Job destroyed unsuccessfully!'
    ],
    'fields' => [
        'queue' => 'Queue',
        'payload' => 'Payload',
        'attempts' => 'Attempts',
        'reserved_at' => 'Reserved At',
        'available_at' => 'Available At',
        'created_at' => 'Created At',

    ],
    'placeholders' => [

    ],
    'columns' => [
        'queue' => 'Queue',
        'payload' => 'Payload',
        'attempts' => 'Attempts',
        'reserved_at' => 'Reserved At',
        'available_at' => 'Available At',
        'created_at' => 'Created At',

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
        'aggregate' => [
            'attempts' => 'attempts'
        ]
    ]
];
