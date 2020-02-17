<?php

return [
    'labels' => [
        'singular' => 'Shipment',
        'plural' => 'Shipments',
        'create' => 'Create CustomerShipment'
    ],
    'index' => [
        'title' => 'List of Customer Shipment',
    ],
    'trashed' => [
        'title' => 'List of trashed Customer Shipment',
    ],
    'create' => [
        'title' => 'Create Customer Shipment',
    ],
    'store' => [
        'success' => 'Customer Shipment created successfully!',
        'error' => 'Customer Shipment created unsuccessfully!'
    ],
    'show' => [
        'title' => 'Customer Shipment',
    ],
    'edit' => [
        'title' => 'Edit Customer Shipment',
    ],
    'update' => [
        'success' => 'Customer Shipment updated successfully!',
        'error' => 'Customer Shipment updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move Customer Shipment to trash',
        'success' => 'Customer Shipment trashed successfully!',
        'error' => 'Customer Shipment trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore Customer Shipment',
        'success' => 'Customer Shipment restored successfully!',
        'error' => 'Customer Shipment restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy Customer Shipment',
        'success' => 'Customer Shipment destroyed successfully!',
        'error' => 'Customer Shipment destroyed unsuccessfully!'
    ],
    'package_list' => [
        'title' => 'Package List',
    ],
    'waybill' => [
        'title' => 'Waybill',
    ],
    'invoice' => [
        'title' => 'Create Invoice',
    ],
    'fields' => [
        'number' => 'Number',
        'assembly_number' => 'Assembly Number',
        'invoice_number' => 'Invoice Number',
        'status' => 'Status',
        'delivery_type' => 'Delivery Type',
        'packages_quantity' => 'Packages Quantity',
        'comment' => 'Comment',
        'packageType' => [
            'name' => 'Package Type',
        ],
        'customer' => [
            'name' => 'Customer',
        ],
        'customer_id' => [
            'name' => 'Customer',
        ],
        'user' => [
            'name' => 'User',
        ],
    ],
    'placeholders' => [
        'packageType' => 'Select Package Type',
        'customer' => 'Select Customer',
        'user' => 'Select User',
    ],
    'columns' => [
        'number' => 'Number',
        'assembly_number' => 'Assembly Number',
        'invoice_number' => 'Invoice Number',
        'status' => 'Status',
        'delivery_type' => 'Delivery Type',
        'packages_quantity' => 'Packages Quantity',
        'comment' => 'Comment',
        'packageType' => [
            'name' => 'Package Type',
        ],
        'customer' => [
            'name' => 'Customer',
        ],
        'user' => [
            'name' => 'User',
        ],
        'customerOrderItems' => [
            'customerOrder' => [
                'number' => 'Order Numbers',
                'batch_number' => 'Batch Numbers',
            ]
        ],
        'delivery_date' => 'Delivery Date',
        'order_numbers' => 'Order Numbers',
        'order_batch_numbers' => 'Batch Numbers',
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
        'packageType' => [
            'name' => 'Package Type',
        ],
        'customer' => [
            'name' => 'Customer',
        ],
        'user' => [
            'name' => 'User',
        ],
        'status' => 'Status',
        'number' => 'Number',
    ],
    'statuses' => [
        'open' => 'Open',
        'assembly' => 'Assembly',
        'shipment' => 'Shipment',
        'invoice' => 'Invoice',
        'reject' => 'Reject',
    ],
];
