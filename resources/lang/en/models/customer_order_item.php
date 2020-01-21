<?php

return [
    'labels' => [
        'singular' => 'CustomerOrderItem',
        'plural' => 'CustomerOrderItem',
        'create' => 'Create CustomerOrderItem'
    ],
    'index' => [
        'title' => 'List of CustomerOrderItem',
    ],
    'trashed' => [
        'title' => 'List of trashed CustomerOrderItem',
    ],
    'create' => [
        'title' => 'Create CustomerOrderItem',
    ],
    'store' => [
        'success' => 'CustomerOrderItem created successfully!',
        'error' => 'CustomerOrderItem created unsuccessfully!'
    ],
    'show' => [
        'title' => 'CustomerOrderItem',
    ],
    'edit' => [
        'title' => 'Edit CustomerOrderItem',
    ],
    'update' => [
        'success' => 'CustomerOrderItem updated successfully!',
        'error' => 'CustomerOrderItem updated unsuccessfully!'
    ],
    'trash' => [
        'title' => 'Move CustomerOrderItem to trash',
        'success' => 'CustomerOrderItem trashed successfully!',
        'error' => 'CustomerOrderItem trashed unsuccessfully!'
    ],
    'restore' => [
        'title' => 'Restore CustomerOrderItem',
        'success' => 'CustomerOrderItem restored successfully!',
        'error' => 'CustomerOrderItem restored unsuccessfully!'
    ],
    'destroy' => [
        'title' => 'Destroy CustomerOrderItem',
        'success' => 'CustomerOrderItem destroyed successfully!',
        'error' => 'CustomerOrderItem destroyed unsuccessfully!'
    ],
    'fields' => [
        'status' => 'Status',
        'product_name' => 'Product Name',
        'sales_unit_quantity' => 'Sales Unit Quantity',
        'product_manual_price' => 'Product Manual Price',
        'product_price' => 'Product Price',
        'vat' => 'Vat',
        'product_vat_price' => 'Product Vat Price',
        'products_quantity' => 'Products Quantity',
        'packages_quantity' => 'Packages Quantity',
        'total_price' => 'Total Price',
        'total_vat_price' => 'Total Vat Price',
        'deposit_enabled' => 'Deposit Enabled',
        'deposit_price' => 'Deposit Price',
        'deposit_vat' => 'Deposit Vat',
        'deposit_vat_price' => 'Deposit Vat Price',
        'deposit_total_price' => 'Deposit Total Price',
        'deposit_total_vat' => 'Deposit Total Vat',
        'deposit_total_vat_price' => 'Deposit Total Vat Price',
        'bypass' => 'Bypass',
        'back_order' => 'Back Order',
        'cancelled' => 'Cancelled',
        'expected_date' => 'Expected Date',
        'customer' => [
            'name' => 'Customer',
            'payment_conditions' => 'Conditions',
            'user' => [
                'name' => 'Manager',
            ],
        ],
        'customerOrder' => [
            'delivery_month' => 'Delivery Month',
            'delivery_date' => 'Delivery Date',
            'delivery_type' => 'Delivery Type',
            'name' => 'Order Number',
            'invoice_number' => 'Invoice Number',
            'batch_number' => 'Batch number',
            'customer' => [
                'name' => 'Customer',
                'payment_conditions' => 'Conditions',
                'user' => [
                    'name' => 'Manager',
                ],
            ],
        ],
        'customerShipment' => [
            'number' => 'Shipment Number',
            'assembly_number' => 'Assembly',
            'invoice_number' => 'Invoice Number',
            'delivery_month' => 'Shipment Month',
            'delivery_date' => 'Shipment Date',
        ],
        'product' => [
            'name' => 'Product',
            'productGroup' => [
                'name' => 'Product Group',
            ],
        ],
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
    ],
    'placeholders' => [
        'product' => 'Select Product',
        'customer' => 'Select Customer',
        'customerOrder' => 'Select Customer Order',
        'customerShipment' => 'Select Customer Shipment',
		'customerInvoice' => 'Select Customer Invoice',
    ],
    'columns' => [
        'status' => 'Status',
        'product_name' => 'Product Name',
        'sales_unit_quantity' => 'Sales Unit Quantity',
        'product_manual_price' => 'Product Manual Price',
        'product_price' => 'Product Price',
        'vat' => 'Vat',
        'product_vat_price' => 'Product Vat Price',
        'products_quantity' => 'Products Quantity',
        'packages_quantity' => 'Packages Quantity',
        'total_price' => 'Total Price',
        'total_vat_price' => 'Total Vat Price',
        'deposit_enabled' => 'Deposit Enabled',
        'deposit_price' => 'Deposit Price',
        'deposit_vat' => 'Deposit Vat',
        'deposit_vat_price' => 'Deposit Vat Price',
        'deposit_total_price' => 'Deposit Total Price',
        'deposit_total_vat' => 'Deposit Total Vat',
        'deposit_total_vat_price' => 'Deposit Total Vat Price',
        'bypass' => 'Bypass',
        'back_order' => 'Back Order',
        'cancelled' => 'Cancelled',
        'expected_date' => 'Expected Date',
        'customer' => [
            'name' => 'Customer',
            'payment_conditions' => 'Conditions',
            'user' => [
                'name' => 'Manager',
            ],
        ],
        'customerOrder' => [
            'delivery_month' => 'Delivery Month',
            'delivery_date' => 'Delivery Date',
            'delivery_type' => 'Delivery Type',
            'number' => 'Order Number',
            'invoice_number' => 'Invoice Number',
            'batch_number' => 'Batch number',
            'customer' => [
                'name' => 'Customer',
                'payment_conditions' => 'Conditions',
                'user' => [
                    'name' => 'Manager',
                ],
            ],
        ],
        'customerShipment' => [
            'number' => 'Shipment Number',
            'assembly_number' => 'Assembly',
            'invoice_number' => 'Invoice Number',
            'delivery_month' => 'Shipment Month',
            'delivery_date' => 'Shipment Date',
        ],
        'product' => [
            'name' => 'Product',
            'productGroup' => [
                'name' => 'Product Group',
            ],
        ],
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'deleted_at' => 'Trashed',
    ],
    'filters' => [
        'customer' => [
            'name' => 'Customer',
            'user' => [
                'name' => 'Manager',
            ],
        ],
        'product' => [
            'name' => 'Product',
            'productGroup' => [
                'name' => 'Product Group',
            ],
        ],
        'customerOrder' => [
            'number' => 'Order Date',
        ],
        'customerShipment' => [
            'number' => 'Shipment Number',
            'invoice_number' => 'Invoice',
            'assembly_number' => 'Assembly Number',
        ],
		'customerInvoice' => [
			'name' => 'Customer Invoice',
		],
        'customerShipmentAdvanced' => 'Type/Month',
        'bypass' => 'Bypass',
        'back_order' => 'Backorder',
        'cancelled' => 'Cancelled',
        'status' => 'Status',
    ],
];
