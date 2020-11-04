<?php

namespace App;



/**
 * CustomerUserSubscribe
 *
 * @property integer $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \App\Product|null $product
 * @property \App\CustomerUser|null $customerUser
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerUser()
 * @package App
 */
class CustomerUserSubscribe extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    /**
     * @var array
     */
	protected $fillable = [
		'product_id',
		'customer_user_id',
	];

    /**
     * @var array
     */
	protected $appends = [

	];

    /**
     * @var array
     */
	protected $casts = [

	];

    /**
     * @var array
     */
	protected $dates = [

	];

    /**
     * @var array
     */
    protected $images = [

    ];

    /**
     * @var array
     */
    protected $files = [

    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * @var array
     */
    protected $belongsTo = [
		'product' => [\App\Product::class, 'product_id'],
		'customerUser' => [\App\CustomerUser::class, 'customer_user_id'],
    ];

    /**
     * @var array
     */
    protected $belongsToMany = [

    ];

    /**
     * @var array
     */
    protected $belongsToManyPivot = [

    ];

    /**
     * @var array
     */
    protected $belongsToManyPivotTimestamps = [

    ];

    /**
     * @var array
     */
    protected $hasOne = [

    ];

    /**
     * @var array
     */
    protected $hasMany = [

    ];

    /**
     * @var array
     */
    protected $hasManyThrough = [

    ];

    /**
     * @var array
     */
    protected $morphTo = [

    ];

    /**
     * @var array
     */
    protected $morphOne = [

    ];

    /**
     * @var array
     */
    protected $morphMany = [

    ];

    /**
     * @var array
     */
    protected $morphToMany = [

    ];

    /**
     * @var array
     */
    protected $morphedByMany = [

    ];

    /**
     * @var array
     */
    protected $with = [

    ];

    /**
     * @var array
     */
    protected $touches = [

    ];
}
