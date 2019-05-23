<?php

namespace App;

/**
 * Company
 *
 * @property string $name
 * @property string $legal_name
 * @property string $short_name
 * @property string $postcode
 * @property string $address
 * @property string $bid
 * @property string $email
 * @property string $phone
 * @property string $code
 * @property string $smtp_host
 * @property string $smtp_port
 * @property string $smtp_encryption
 * @property string $smtp_username
 * @property string $smtp_password
 * @property string $smtp_from
 * @property string $smtp_from_name
 *
 * @property \App\Region $region
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo region()
 *
 *
 * @package App
 */
class Company extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'name',
		'legal_name',
		'short_name',
		'postcode',
		'address',
		'bid',
		'email',
		'phone',
		'code',
		'smtp_host',
		'smtp_port',
		'smtp_encryption',
		'smtp_username',
		'smtp_password',
		'smtp_from',
		'smtp_from_name',
		'region_id',
	];

	protected $casts = [

	];

	protected $dates = [

	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'region' => \App\Region::class,
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
		'region',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}