<?php

namespace App;

/**
 * CustomerUserToken
 *
 * @property integer $id
 * @property string $token
 * @property string $ip_address
 * @property string $user_agent
 * @property \App\CustomerUser $customerUser

 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerUser()

 * @package App
 */
class CustomerUserToken extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'token',
		'ip_address',
		'user_agent',
		'customer_user_id',
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
		'customerUser',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}