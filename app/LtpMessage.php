<?php

namespace App;



/**
 * LtpMessage
 *
 * @property integer $id
 * @property string $sender_identifier
 * @property string $sender_description
 * @property string $filename_hint
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @package App
 */
class LtpMessage extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{




    /**
     * @var array
     */
	protected $fillable = [
		'sender_identifier',
		'sender_description',
		'filename_hint',
		'content',
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

	];

    /**
     * @var array
     */
	protected $dates = [

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
