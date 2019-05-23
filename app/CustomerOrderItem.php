<?php

namespace App;

/**
 * CustomerOrderItem
 *
 * @property string $status
 * @property string $product_name
 * @property float $sales_unit_quantity
 * @property boolean $product_manual_price
 * @property float $product_price
 * @property integer $vat
 * @property float $product_vat_price
 * @property integer $products_quantity
 * @property integer $packages_quantity
 * @property float $total_price
 * @property float $total_vat_price
 * @property boolean $deposit_enabled
 * @property float $deposit_price
 * @property integer $deposit_vat
 * @property float $deposit_vat_price
 * @property float $deposit_total_price
 * @property float $deposit_total_vat
 * @property float $deposit_total_vat_price
 * @property boolean $bypass
 * @property boolean $back_order
 * @property boolean $cancelled
 * @property \Carbon\Carbon $expected_date
 *
 * @property \App\Product $product
 * @property \App\Customer $customer
 * @property \App\CustomerOrder $customerOrder
 * @property \App\CustomerShipment $customerShipment
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerOrder()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerShipment()
 *
 *
 * @package App
 */
class CustomerOrderItem extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'status',
		'product_name',
		'sales_unit_quantity',
		'product_manual_price',
		'product_price',
		'vat',
		'product_vat_price',
		'products_quantity',
		'packages_quantity',
		'total_price',
		'total_vat_price',
		'deposit_enabled',
		'deposit_price',
		'deposit_vat',
		'deposit_vat_price',
		'deposit_total_price',
		'deposit_total_vat',
		'deposit_total_vat_price',
		'bypass',
		'back_order',
		'cancelled',
		'expected_date',
		'product_id',
		'customer_id',
		'customer_order_id',
		'customer_shipment_id',
	];

	protected $casts = [
		'sales_unit_quantity' => 'float',
		'product_manual_price' => 'boolean',
		'product_price' => 'float',
		'vat' => 'integer',
		'product_vat_price' => 'float',
		'products_quantity' => 'integer',
		'packages_quantity' => 'integer',
		'total_price' => 'float',
		'total_vat_price' => 'float',
		'deposit_enabled' => 'boolean',
		'deposit_price' => 'float',
		'deposit_vat' => 'integer',
		'deposit_vat_price' => 'float',
		'deposit_total_price' => 'float',
		'deposit_total_vat' => 'float',
		'deposit_total_vat_price' => 'float',
		'bypass' => 'boolean',
		'back_order' => 'boolean',
		'cancelled' => 'boolean',
	];

	protected $dates = [
		'expected_date',
	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'product' => \App\Product::class,
		'customer' => \App\Customer::class,
		'customerOrder' => \App\CustomerOrder::class,
		'customerShipment' => \App\CustomerShipment::class,
    ];

    protected $belongsToMany = [

    ];

    protected $belongsToManyPivot = [

    ];

    protected $belongsToManyPivotTimestamps = [

    ];

    protected $hasMany = [

    ];

    protected $hasManyThrough = [

    ];

    protected $morphTo = [

    ];

    protected $morphMany = [

    ];

    protected $with = [
		'product',
		'customer',
		'customerOrder',
		'customerShipment',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}