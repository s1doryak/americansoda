<?php

namespace App;

/**
 * PriceGroup
 *
 * @property integer $id
 * @property string $name
 * @property boolean $manual


 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at


 * @package App
 */
class PriceGroup extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'name',
		'manual',
	];

	protected $appends = [

	];

	protected $casts = [
		'manual' => 'boolean',
	];

	protected $dates = [

	];

    protected $hidden = [

    ];

    protected $belongsTo = [

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
		'customers' => \App\Customer::class,
		'priceGroupBreakpoints' => \App\PriceGroupBreakpoint::class,
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