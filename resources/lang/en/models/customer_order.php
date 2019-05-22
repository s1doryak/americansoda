<?php

return [
    'labels' => [
        'singular' => 'CustomerOrder',
        'plural' => 'CustomerOrder',
		'create' => 'Create CustomerOrder'
    ],
	'index' => [
		'title' => 'List of CustomerOrder',
	],
    'trashed' => [
        'title' => 'List of trashed CustomerOrder',
    ],
	'create' => [
		'title' => 'Create CustomerOrder',
	],
    'store' => [
	    'success' => 'CustomerOrder created successfully!',
	    'error' => 'CustomerOrder created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerOrder',
    ],
	'edit' => [
		'title' => 'Edit CustomerOrder',
	],
	'update' => [
		'success' => 'CustomerOrder updated successfully!',
		'error' => 'CustomerOrder updated unsuccessfully!'
	],
	'trash' => [
        'title' => 'Move CustomerOrder to trash',
		'success' => 'CustomerOrder trashed successfully!',
		'error' => 'CustomerOrder trashed unsuccessfully!'
	],
    'restore' => [
        'title' => 'Restore CustomerOrder',
        'success' => 'CustomerOrder restored successfully!',
        'error' => 'CustomerOrder restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerOrder',
        'success' => 'CustomerOrder destroyed successfully!',
        'error' => 'CustomerOrder destroyed unsuccessfully!'
    ],
	'fields' => [
		'number' => 'Number',
		'batch_number' => 'Batch Number',
		'comment' => 'Comment',
		'fc_overdue' => 'Fc Overdue',
		'fc_comment' => 'Fc Comment',
		'fc_future_comment' => 'Fc Future Comment',
		'sent_at' => 'Sent At',
		'customer' => [
			'name' => 'Customer',
		],
		'user' => [
			'name' => 'User',
		],
	],
    'placeholders' => [
		'customer' => 'Select Customer',
		'user' => 'Select User',
    ],
    'columns' => [
		'number' => 'Number',
		'batch_number' => 'Batch Number',
		'comment' => 'Comment',
		'fc_overdue' => 'Fc Overdue',
		'fc_comment' => 'Fc Comment',
		'fc_future_comment' => 'Fc Future Comment',
		'sent_at' => 'Sent At',
		'customer' => [
			'name' => 'Customer',
		],
		'user' => [
			'name' => 'User',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
		'customer' => [
			'name' => 'Customer',
		],
		'user' => [
			'name' => 'User',
		],
    ],
];