<?php

namespace App;

use Crmplease\MaterialAdmin\Database\Eloquent\Model;

/**
 * Stock
 *
 * @property string $name
 * @property string $postcode
 * @property string $address
 *
 * @property \App\Region $region
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo region()
 *
 *
 * @package App
 */
class Stock extends Model
{
	protected $fillable = [
		'name',
		'postcode',
		'address',
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