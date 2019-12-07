<?php

namespace App;


/**
 * Banner
 *
 * @property integer $id
 * @property string $name
 * @property \Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageField $image
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Collection|\App\CustomerType[] $customerTypes
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany customerTypes()
 * @package App
 */
class Banner extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'name',
        'image',
        'url',
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
        'customerTypes' => [\App\CustomerType::class, 'banner_customer_type'],
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

    protected $morphOne = [

    ];

    protected $morphMany = [

    ];

    protected $morphToMany = [

    ];

    protected $morphedByMany = [

    ];

    protected $with = [
//		'customerTypes',
    ];

    protected $touches = [
        'customerTypes',
    ];
}
