<?php

namespace App;



/**
 * ProductType
 *
 * @property integer $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Collection|\App\ProductGroup[] $productGroups
 * @method \Illuminate\Database\Eloquent\Relations\HasMany productGroups()
 * @property \Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageField $image
 * @package App
 */
class ProductType extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'name',
		'image',
	];

	protected $appends = [

	];

	protected $casts = [

	];

	protected $dates = [

	];

    protected $images = [
		'image',
	];

    protected $files = [

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
		'productGroups' => \App\ProductGroup::class,
    ];

    protected $hasManyThrough = [

    ];

    protected $morphTo = [

    ];

    protected $morphOne = [

    ];

    protected $morphMany = [

    ];

    protected $morphToMany = [

    ];

    protected $morphedByMany = [

    ];

    protected $with = [

    ];

    protected $touches = [

    ];
}
