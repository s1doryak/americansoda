<?php

return [
    'labels' => [
        'singular' => 'Order',
        'plural' => 'Orders',
        'create' => 'Create CustomerOrder'
    ],
    'index' => [
        'title' => 'List of Customer Order',
    ],
    'trashed' => [
        'title' => 'List of trashed Customer Order',
    ],
    'create' => [
        'title' => 'Create Customer Order',
    ],
    'store' => [
        'success' => 'Customer Order created successfully!',
        'error' => 'Customer Order created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Order',
    ],
    'edit' => [
        'title' => 'Edit Customer Order',
    ],
    'update' => [
        'success' => 'Customer Order updated successfully!',
        'error' => 'Customer Order updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move Customer Order to trash',
        'success' => 'Customer Order trashed successfully!',
        'error' => 'Customer Order trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore Customer Order',
        'success' => 'Customer Order restored successfully!',
        'error' => 'Customer Order restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Order',
        'success' => 'Customer Order destroyed successfully!',
        'error' => 'Customer Order destroyed unsuccessfully!'
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
