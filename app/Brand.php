<?php

namespace App;

use Crmplease\MaterialAdmin\Database\Eloquent\Model;

/**
 * Brand
 *
 * @property string $name
 * @property string $logo
 *
 *
 *
 *
 *
 * @package App
 */
class Brand extends Model
{
	protected $fillable = [
		'name',
		'logo',
	];

	protected $casts = [

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
		'logo',
    ];

    protected $files = [

    ];
}