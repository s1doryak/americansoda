<?php

namespace App;

use Crmplease\MaterialAdmin\Database\Eloquent\Model;

/**
 * CustomerShipment
 *
 * @property string $number
 * @property string $assembly_number
 * @property string $invoice_number
 * @property string $status
 * @property string $delivery_type
 * @property integer $packages_quantity
 * @property string $comment
 *
 * @property \App\PackageType $packageType
 * @property \App\Customer $customer
 * @property \App\User $user
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo packageType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user()
 *
 *
 * @package App
 */
class CustomerShipment extends Model
{
	protected $fillable = [
		'number',
		'assembly_number',
		'invoice_number',
		'status',
		'delivery_type',
		'packages_quantity',
		'comment',
		'package_type_id',
		'customer_id',
		'user_id',
	];

	protected $casts = [
		'packages_quantity' => 'integer',
	];

	protected $dates = [

	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'packageType' => \App\PackageType::class,
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
		'packageType',
		'customer',
		'user',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}