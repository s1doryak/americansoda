<?php

namespace App;

/**
 * FailedJob
 *
 * @property string $connection
 * @property string $queue
 * @property object $payload
 * @property string $exception
 * @property \Illuminate\Support\Carbon|null $failed_at
 *
 * @package App
 */
class FailedJob extends \Illuminate\Database\Eloquent\Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'connection',
        'queue',
        'payload',
        'exception',
        'failed_at',
    ];

    protected $casts = [
        'payload' => 'object',
    ];

    protected $dates = [
        'failed_at',
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
