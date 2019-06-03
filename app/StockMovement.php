<?php

namespace App;

/**
 * StockMovement
 *
 * @property string $movement_type
 * @property \App\Stock $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stock()
 *
 * @package App
 */
class StockMovement extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'movement_type',
		'stock_id',
	];

	protected $casts = [

	];

	protected $dates = [

	];

	protected $hidden = [

	];

	protected $belongsTo = [
		'stock' => \App\Stock::class,
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
		'stockMovementProducts' => StockMovementProduct::class,
	];

	protected $hasManyThrough = [

	];

	protected $morphTo = [

	];

	protected $morphMany = [

	];

	protected $with = [
		'stock',
	];

	protected $images = [

	];

	protected $files = [

	];

	/**
	 * @return array
	 */
	public function getWith()
	{
		$condition = is_resource_page(['stock_movement']) || is_datatable(['stock_movement']);

		return [
			$condition ? 'stock' : null,
		];
	}
}
