<?php

namespace App;

/**
 * Brand
 *
 * @property string $name
 * @property string $logo
 * @property \Illuminate\Support\Collection|Product[] $products
 * @method \Illuminate\Database\Eloquent\Relations\HasMany products()
 *
 *
 *
 * @package App
 */
class Brand extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'name',
		'logo',
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
		'products' => Product::class,
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
		'logo',
	];

	protected $files = [

	];
}
