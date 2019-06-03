<?php

namespace App;

/**
 * Job
 *
 * @property string $queue
 * @property object $payload
 * @property integer $attempts
 * @property \Illuminate\Support\Carbon|null|null $reserved_at
 * @property \Illuminate\Support\Carbon|null $available_at
 * @property \Illuminate\Support\Carbon|null $created_at
 *
 * @package App
 */
class Job extends \Illuminate\Database\Eloquent\Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'queue',
        'payload',
        'attempts',
        'reserved_at',
        'available_at',
        'created_at',
    ];

    protected $casts = [
        'payload' => 'object',
        'attempts' => 'integer',
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
