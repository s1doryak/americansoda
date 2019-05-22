<?php

namespace App;

use Crmplease\MaterialAdmin\Database\Eloquent\Model;

/**
 * Product
 *
 * @property string $name
 * @property string $product_barcode
 * @property string $product_barcode_plaintext
 * @property string $package_barcode
 * @property string $package_barcode_plaintext
 * @property string $product_image
 * @property string $package_image
 * @property string $description
 * @property string $contents
 * @property integer $number_in_package
 * @property float $weight
 * @property float $volume
 * @property float $brutto_weight
 * @property float $brutto_volume
 * @property boolean $deposit_enabled
 * @property float $deposit_price
 * @property integer $deposit_vat
 * @property float $deposit_vat_price
 * @property string $comment
 *
 * @property \App\Brand $brand
 * @property \App\PackageType $packageType
 * @property \App\ProductGroup $productGroup
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo brand()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo packageType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo productGroup()
 *
 *
 * @package App
 */
class Product extends Model
{
	protected $fillable = [
		'name',
		'product_barcode',
		'product_barcode_plaintext',
		'package_barcode',
		'package_barcode_plaintext',
		'product_image',
		'package_image',
		'description',
		'contents',
		'number_in_package',
		'weight',
		'volume',
		'brutto_weight',
		'brutto_volume',
		'deposit_enabled',
		'deposit_price',
		'deposit_vat',
		'deposit_vat_price',
		'comment',
		'brand_id',
		'package_type_id',
		'product_group_id',
	];

	protected $casts = [
		'number_in_package' => 'integer',
		'weight' => 'float',
		'volume' => 'float',
		'brutto_weight' => 'float',
		'brutto_volume' => 'float',
		'deposit_enabled' => 'boolean',
		'deposit_price' => 'float',
		'deposit_vat' => 'integer',
		'deposit_vat_price' => 'float',
	];

	protected $dates = [

	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'brand' => \App\Brand::class,
		'packageType' => \App\PackageType::class,
		'productGroup' => \App\ProductGroup::class,
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
		'brand',
		'packageType',
		'productGroup',
    ];

    protected $images = [
		'product_image',
		'package_image',
    ];

    protected $files = [

    ];
}