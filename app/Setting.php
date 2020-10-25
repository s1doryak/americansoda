<?php

namespace App;



/**
 * Setting
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @package App
 */
class Setting extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    /**
     * @var array
     */
	protected $fillable = [
		'name',
		'value',
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

    public function getValueAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setValueAttribute($value)
    {
        $value = array_values($value);
        $this->attributes['value'] = json_encode($value);
    }
}
