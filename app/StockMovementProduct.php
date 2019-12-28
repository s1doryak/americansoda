<?php

namespace App;

use Carbon\Carbon;

/**
 * StockMovementProduct
 *
 * @property string $product_name
 * @property integer $products_quantity
 * @property string $delivery_number
 * @property \Illuminate\Support\Carbon|null $expiration_date
 * @property string $movement_type
 * @property string $comment
 * @property \App\StockMovement $stockMovement
 * @property \App\Product $product
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stockMovement()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()
 *
 * @package App
 */
class StockMovementProduct extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'product_name',
        'products_quantity',
        'delivery_number',
        'expiration_date',
        'movement_type',
        'comment',
        'stock_movement_id',
        'product_id',
    ];

    protected $appends = [
        'formatted_products_quantity',
    ];

    protected $casts = [
        'products_quantity' => 'integer',
    ];

    protected $dates = [
        'expiration_date',
    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'stockMovement' => \App\StockMovement::class,
        'product' => \App\Product::class,
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

    ];

    protected $files = [

    ];

    /**
     * @return string
     */
    public function getFormattedProductsQuantityAttribute()
    {
        if (is_null($this->stockMovement)) {
            return $this->renderDefaultView();
        }

        if ($this->stockMovement->movement_type === 'receipt') {
            $class = 'green';
            $value = '+' . $this->attributes['products_quantity'];
        } else {
            $class = 'red';
            $value = '-' . $this->attributes['products_quantity'];
        }

        return sprintf('<span class="%s">%s</span>', $class, $value);
    }

    /**
     * @return string
     */
    public function getExpirationDateAttribute()
    {
        return ''; // $this->formatDateForForm('expiration_date');
    }

    /**
     * @param $value
     */
    public function setExpirationDateAttribute($value)
    {
        if (is_date($value, 'Y-m-d H:i:s')) {
            $this->attributes['expiration_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        } elseif (is_date($value, 'd/m/Y')) {
            $this->attributes['expiration_date'] = Carbon::createFromFormat('d/m/Y', $value);
        } else {
            $this->attributes['expiration_date'] = null;
        }
    }
}
