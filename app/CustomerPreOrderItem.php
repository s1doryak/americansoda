<?php

namespace App;

/**
 * CustomerPreOrderItem
 *
 * @property integer $id
 * @property string $quantity
 * @property string $products_quantity
 * @property string $price
 * @property string $vat_price
 * @property string $total_price
 * @property string $total_vat_price
 * @property string $deposit_price
 * @property string $deposit_vat_price
 * @property string $total_deposit_price
 * @property string $total_deposit_vat_price
 * @property \App\CustomerPreOrder $customerPreOrder
 * @property \App\CustomerUser $customerUser
 * @property \App\Customer $customer
 * @property \App\Product $product

 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerPreOrder()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerUser()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()

 * @package App
 */
class CustomerPreOrderItem extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'quantity',
		'products_quantity',
		'price',
		'vat_price',
		'total_price',
		'total_vat_price',
		'deposit_price',
		'deposit_vat_price',
		'total_deposit_price',
		'total_deposit_vat_price',
		'customer_pre_order_id',
		'customer_user_id',
		'customer_id',
		'product_id',
	];

	protected $appends = [

	];

	protected $casts = [

	];

	protected $dates = [

	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'customerPreOrder' => \App\CustomerPreOrder::class,
		'customerUser' => \App\CustomerUser::class,
		'customer' => \App\Customer::class,
		'product' => \App\Product::class,
    ];

    protected $belongsToMany = [

    ];

    protected $belongsToManyPivot = [

    ];

    protected $belongsToManyPivotTimestamps = [

    ];

    protected $hasOne = [

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

    ];

    protected $images = [

    ];

    protected $files = [

    ];
}
