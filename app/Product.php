<?php

namespace App;

use Carbon\Carbon;

/**
 * Product
 *
 * @property string $name
 * @property string $product_barcode
 * @property string $product_barcode_plaintext
 * @property string $package_barcode
 * @property string $package_barcode_plaintext
 * @property \Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageField $product_image
 * @property \Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageField $package_image
 * @property string $description
 * @property string $contents
 * @property integer $number_in_package
 * @property float $weight
 * @property float $volume
 * @property float $brutto_weight
 * @property float $brutto_volume
 * @property string $unit_type
 * @property boolean $deposit_enabled
 * @property float $deposit_price
 * @property integer $deposit_vat
 * @property float $deposit_vat_price
 * @property string $comment
 * @property \App\Brand $brand
 * @property \App\PackageType $packageType
 * @property \App\ProductGroup $productGroup
 * @property \Illuminate\Support\Collection|\App\ProductTag[] $productTags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo brand()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo packageType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo productGroup()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany productTags()
 *
 * @property float $discount_price
 * @property boolean $new
 * @property boolean $action
 * @property \Illuminate\Support\Carbon|null $future_stock_movement
 * @property string $displayed_text
 * @package App
 */
class Product extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
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
        'unit_type',
		'deposit_enabled',
		'deposit_price',
		'deposit_vat',
		'deposit_vat_price',
		'comment',
		'brand_id',
		'package_type_id',
		'product_group_id',
		'discount_price',
		'new',
		'action',
		'future_stock_movement',
		'displayed_text',
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
		'new' => 'boolean',
		'action' => 'boolean',
	];

	protected $dates = [
		'future_stock_movement',
	];

	protected $hidden = [

	];

	protected $belongsTo = [
		'brand' => \App\Brand::class,
		'packageType' => \App\PackageType::class,
		'productGroup' => \App\ProductGroup::class,
	];

	protected $belongsToMany = [
		'productTags' => [\App\ProductTag::class, 'product_product_tag'],
	];

	protected $belongsToManyPivot = [

	];

	protected $belongsToManyPivotTimestamps = [

	];

	protected $hasOne = [

	];

	protected $hasMany = [
		'customerOrderItems' => CustomerOrderItem::class,
        'customerUserSubscribes' => CustomerUserSubscribe::class,
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
		'product_image',
		'package_image',
	];

	protected $files = [

	];

	/**
	 * @return string
	 */
	public function getProductBarcodeAttribute()
	{
		return transform_barcode($this->attributes['product_barcode']);
	}

	/**
	 * @return string
	 */
	public function getPackageBarcodeAttribute()
	{
		return transform_barcode($this->attributes['package_barcode']);
	}

	public function getFutureStockMovementWeeks()
    {
        /** @var Carbon  $futureStockMovement */
        $futureStockMovement = $this->attributes['future_stock_movement'];
        $expectedWeek = Carbon::now()->diffInWeeks($futureStockMovement);

        return $futureStockMovement ? sprintf('vko %s', $expectedWeek) : null;
    }
}
