<?php

namespace App;

/**
 * StockMovement
 *
 * @property string $movement_type
 *
 * @property \App\Stock $stock
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stock()
 *
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

    protected $hasMany = [

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
}