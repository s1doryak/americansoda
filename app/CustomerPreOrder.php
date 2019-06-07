<?php

namespace App;

/**
 * CustomerPreOrder
 *
 * @property integer $id
 * @property string $number
 * @property string $reference_number
 * @property string $comment
 * @property \App\CustomerUser $customerUser
 * @property \App\CustomerOrder $customerOrder
 * @property \App\Customer $customer

 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerUser()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerOrder()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()

 * @package App
 */
class CustomerPreOrder extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'number',
		'reference_number',
		'comment',
		'customer_user_id',
		'customer_order_id',
		'customer_id',
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
		'customerUser' => \App\CustomerUser::class,
		'customerOrder' => \App\CustomerOrder::class,
		'customer' => \App\Customer::class,
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
		'items' => \App\CustomerPreOrderItem::class,
    ];

    protected $hasManyThrough = [

    ];

    protected $morphTo = [

    ];

    protected $morphMany = [

    ];

    protected $with = [
		'customerUser',
		'customerOrder',
		'customer',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}