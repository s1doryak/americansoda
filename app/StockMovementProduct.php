<?php

namespace App;

/**
 * StockMovementProduct
 *
 * @property string $product_name
 * @property integer $products_quantity
 * @property string $delivery_number
 * @property \Carbon\Carbon $expiration_date
 * @property string $movement_type
 * @property string $comment
 *
 * @property \App\StockMovement $stockMovement
 * @property \App\Product $product
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stockMovement()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()
 *
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
        'stockMovement',
        'product',
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
        $condition = is_resource_page(['stock_movement_product', 'stock_movement.product']) || is_datatable(['stock_movement_product', 'stock_movement.product']);

        return [
            $condition ? 'stockMovement' : null,
            $condition ? 'stockMovement.stock' : null,
            $condition ? 'product' : null,
        ];
    }

    /**
     * @return string
     */
    public function getFormattedProductsQuantityAttribute()
    {
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
        return $this->formatDateForForm('expiration_date');
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
