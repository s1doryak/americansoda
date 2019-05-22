<?php

namespace App;

use Crmplease\MaterialAdmin\Database\Eloquent\Model;

/**
 * StockProduct
 *
 * @property string $delivery_number
 * @property \Carbon\Carbon $expiration_date
 *
 * @property \App\Stock $stock
 * @property \App\Product $product
 * @property \App\CustomerOrderItem $customerOrderItem
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stock()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerOrderItem()
 *
 *
 * @package App
 */
class StockProduct extends Model
{
	protected $fillable = [
		'delivery_number',
		'expiration_date',
		'stock_id',
		'product_id',
		'customer_order_item_id',
	];

	protected $casts = [

	];

	protected $dates = [
		'expiration_date',
	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'stock' => \App\Stock::class,
		'product' => \App\Product::class,
		'customerOrderItem' => \App\CustomerOrderItem::class,
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
		'stock',
		'product',
		'customerOrderItem',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}