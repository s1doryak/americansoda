<?php

namespace App;

/**
 * PriceGroupBreakpoint
 *
 * @property integer $id
 * @property string $breakpoint
 * @property \App\PriceGroup $priceGroup
 * @property \Illuminate\Support\Collection|\App\ProductGroup[] $productGroups
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo priceGroup()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany productGroups()
 * @package App
 */
class PriceGroupBreakpoint extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'breakpoint',
		'price_group_id',
	];

	protected $appends = [

	];

	protected $casts = [
		'breakpoint' => 'float',
	];

	protected $dates = [

	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'priceGroup' => \App\PriceGroup::class,
    ];

    protected $belongsToMany = [
		'productGroups' => [\App\ProductGroup::class, 'price_group_breakpoint_product_group'],
    ];

    protected $belongsToManyPivot = [
		'productGroups' => ['price'],
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
		'priceGroup',
		'productGroups',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}