<?php

namespace App;

/**
 * CustomerOrder
 *
 * @property string $number
 * @property string $batch_number
 * @property string $comment
 * @property integer $fc_overdue
 * @property string $fc_comment
 * @property string $fc_future_comment
 * @property \Carbon\Carbon $sent_at
 *
 * @property \App\Customer $customer
 * @property \App\User $user
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user()
 *
 *
 * @package App
 */
class CustomerOrder extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'number',
		'batch_number',
		'comment',
		'fc_overdue',
		'fc_comment',
		'fc_future_comment',
		'sent_at',
		'customer_id',
		'user_id',
	];

	protected $casts = [
		'fc_overdue' => 'integer',
	];

	protected $dates = [
		'sent_at',
	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'customer' => \App\Customer::class,
		'user' => \App\User::class,
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
		'customer',
		'user',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}