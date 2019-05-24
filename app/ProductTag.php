<?php

namespace App;

/**
 * ProductTag
 *
 * @property string $name
 * @property string $icon
 * @property string $color
 *
 *
 *
 *
 *
 * @package App
 */
class ProductTag extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'name',
		'icon',
		'color',
	];

	protected $appends = [

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
		'products' => \App\Product::class,
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

	public function getContentAttribute()
	{
		return $this->renderIconView($this->name, $this->icon, $this->color);
	}

}