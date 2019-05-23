<?php

namespace App;

/**
 * Role
 *
 * @property string $name
 * @property string $slug
 *
 *
 *
 *
 *
 * @package App
 */
class Role extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'name',
		'slug',
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