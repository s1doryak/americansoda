<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * CustomerUser
 *
 * @property integer $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $comment

 * @property \Illuminate\Support\Collection|\App\Customer[] $customers
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at

 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany customers()
 * @package App
 */
class CustomerUser extends \Crmplease\MaterialAdmin\Foundation\Auth\User
{
	protected $fillable = [
		'email',
		'email_verified_at',
		'password',
		'name',
		'phone',
		'comment',
	];

	protected $appends = [

	];

	protected $casts = [

	];

	protected $dates = [
		'email_verified_at',
	];

    protected $hidden = [
		'password',
		'remember_token',
    ];

    protected $belongsTo = [

    ];

    protected $belongsToMany = [
		'customers' => [\App\Customer::class, 'customer_user_customer'],
    ];

    protected $belongsToManyPivot = [

    ];

    protected $belongsToManyPivotTimestamps = [

    ];

    protected $hasOne = [

    ];

    protected $hasMany = [
		'customerUserTokens' => \App\CustomerUserToken::class,
    ];

    protected $hasManyThrough = [

    ];

    protected $morphTo = [

    ];

    protected $morphMany = [

    ];

    protected $with = [
		'customers',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}