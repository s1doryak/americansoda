<?php

namespace App;

/**
 * ProductGroup
 *
 * @property string $name
 * @property integer $vat
 * @property integer $sales_unit_volume
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property \App\ProductType|null $productType
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo productType()
 * @property \Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageField $image
 * @property string $info
 * @property \Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageField $banner
 * @package App
 */
class ProductGroup extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'name',
		'vat',
		'sales_unit_volume',
		'product_type_id',
		'image',
		'info',
		'banner',
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
		'productType' => \App\ProductType::class,
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
        'products' => Product::class,
        'pricingPolicies' => CustomerPricingPolicy::class
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
		'image',
		'banner',
	];

    protected $files = [

    ];
}
