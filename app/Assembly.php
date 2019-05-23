<?php

namespace App;

/**
 * Assembly
 *
 * @property string $number
 * @property string $comment
 *
 *
 *
 *
 *
 * @package App
 */
class Assembly extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'number',
		'comment',
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