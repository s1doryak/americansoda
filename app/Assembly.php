<?php

namespace App;

use Carbon\Carbon;

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

    /**
     * @return Carbon
     */
    public function getAssemblyDateAttribute()
    {
        $matches = [];

        preg_match_all('/(\d{4}).*(\d{2})(\d{2})/', $this->attributes['number'], $matches);

        if (count($matches) && isset($matches[1]) && is_array($matches[1]) && !empty($matches[1])) {
            $date = sprintf('%d-%d-%d', $matches[1][0], $matches[2][0], $matches[3][0]);

            return Carbon::parse($date);
        }

        return Carbon::now();
    }

    /**
     * @return string
     */
    public function getAssemblyListFileName()
    {
        return sprintf('%04d_%s_%02d%02d', $this->assembly_date->year, mb_strtoupper('Keräyslista'), $this->assembly_date->month, $this->assembly_date->day);
    }
}
