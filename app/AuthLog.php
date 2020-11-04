<?php

namespace App;


/**
 * AuthLog
 *
 * @property integer $id
 * @property \Illuminate\Support\Carbon|null $date
 * @property string $loggable_type
 * @property integer $loggable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \App\CustomerUser|null $loggable
 * @method \Illuminate\Database\Eloquent\Relations\MorphTo loggable()
 * @package App
 */
class AuthLog extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    /**
     * @var array
     */
	protected $fillable = [
		'date',
		'loggable_type',
		'loggable_id',
	];

    /**
     * @var array
     */
	protected $appends = [

	];

    /**
     * @var array
     */
	protected $casts = [
		'loggable_id' => 'integer',
	];

    /**
     * @var array
     */
	protected $dates = [
		'date',
	];

    /**
     * @var array
     */
    protected $images = [

    ];

    /**
     * @var array
     */
    protected $files = [

    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * @var array
     */
    protected $belongsTo = [

    ];

    /**
     * @var array
     */
    protected $belongsToMany = [

    ];

    /**
     * @var array
     */
    protected $belongsToManyPivot = [

    ];

    /**
     * @var array
     */
    protected $belongsToManyPivotTimestamps = [

    ];

    /**
     * @var array
     */
    protected $hasOne = [

    ];

    /**
     * @var array
     */
    protected $hasMany = [

    ];

    /**
     * @var array
     */
    protected $hasManyThrough = [

    ];

    /**
     * @var array
     */
    protected $morphTo = [
		'loggable',
    ];

    /**
     * @var array
     */
    protected $morphOne = [

    ];

    /**
     * @var array
     */
    protected $morphMany = [

    ];

    /**
     * @var array
     */
    protected $morphToMany = [

    ];

    /**
     * @var array
     */
    protected $morphedByMany = [

    ];

    /**
     * @var array
     */
    protected $with = [

    ];

    /**
     * @var array
     */
    protected $touches = [

    ];
}
