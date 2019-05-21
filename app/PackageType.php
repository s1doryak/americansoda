<?php

namespace App;

use Crmplease\MaterialAdmin\Database\Eloquent\Model;

/**
 * PackageType
 *
 * @property string $name
 * @property string $description
 *
 *
 *
 *
 *
 * @package App
 */
class PackageType extends Model
{
	protected $fillable = [
		'name',
		'description',
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

    ];

    protected $files = [

    ];
}