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
            $condition ? 'supplierOrder' : null,
        ];
    }

    /**
     * ToDo
     */
    public static function boot()
    {
        parent::boot();

        static::saving(
            function ($model) {
                $attr = 'supplier_order_id';

                if (!isset($model->attributes[$attr]) || empty($model->attributes[$attr])) {
                    $model->{$attr} = null;
                }
            }
        );
    }
}
