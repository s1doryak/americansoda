<?php

return [
    'labels' => [
        'singular' => 'Order',
        'plural' => 'Orders',
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
    'order_review' => [
        'title' => 'Order review',
    ],
    'send_email' => [
        'title' => 'Send email',
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
        'paymentType' => [
            'name' => 'Payment type',
        ],
        'packageType' => [
            'name' => 'Package type',
        ],
        'customer' => [
            'name' => 'Customer',
            'order_interval' => 'Interval',
        ],
        'user' => [
            'name' => 'User',
        ],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
        'number' => 'Number',
        'customer' => [
            'name' => 'Customer',
            'order_interval' => 'Interval',
        ],
        'user' => [
            'name' => 'User',
        ],
    ],
    'statuses' => [
        'open' => 'Open',
        'assembly' => 'Assembly',
        'shipment' => 'Shipment',
        'invoice' => 'Invoice',
        'reject' => 'Reject',
    ],
    'buttons' => [
        'order_review' => 'Order Review',
        'package_list' => 'Package List',
        'waybill' => 'Waybill',
    ],
    'calendar' => [
        'title' => 'Calendar'
    ]
];
