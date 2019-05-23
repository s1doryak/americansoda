<?php

namespace App;

/**
 * CustomerPricingPolicy
 *
 * @property integer $products_range
 * @property float $price
 *
 * @property \App\ProductGroup $productGroup
 * @property \App\Customer $customer
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo productGroup()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 *
 *
 * @package App
 */
class CustomerPricingPolicy extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'products_range',
		'price',
		'product_group_id',
		'customer_id',
	];

	protected $casts = [
		'products_range' => 'integer',
		'price' => 'float',
	];

	protected $dates = [

	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'productGroup' => \App\ProductGroup::class,
		'customer' => \App\Customer::class,
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
		'productGroup',
		'customer',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}