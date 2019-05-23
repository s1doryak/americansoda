<?php

namespace App;

/**
 * StockMovementProduct
 *
 * @property string $product_name
 * @property integer $products_quantity
 * @property string $delivery_number
 * @property \Carbon\Carbon $expiration_date
 * @property string $movement_type
 * @property string $comment
 *
 * @property \App\StockMovement $stockMovement
 * @property \App\Product $product
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stockMovement()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()
 *
 *
 * @package App
 */
class StockMovementProduct extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'product_name',
		'products_quantity',
		'delivery_number',
		'expiration_date',
		'movement_type',
		'comment',
		'stock_movement_id',
		'product_id',
	];

	protected $casts = [
		'products_quantity' => 'integer',
	];

	protected $dates = [
		'expiration_date',
	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'stockMovement' => \App\StockMovement::class,
		'product' => \App\Product::class,
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
		'stockMovement',
		'product',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}