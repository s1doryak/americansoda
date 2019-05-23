<?php

namespace App;

/**
 * ProductGroup
 *
 * @property string $name
 * @property integer $vat
 * @property integer $sales_unit_volume
 *
 *
 *
 *
 *
 * @package App
 */
class ProductGroup extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'name',
		'vat',
		'sales_unit_volume',
	];

	protected $casts = [
		'vat' => 'integer',
		'sales_unit_volume' => 'integer',
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