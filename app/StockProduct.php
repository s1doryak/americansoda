<?php

namespace App;

/**
 * StockProduct
 *
 * @property string $delivery_number
 * @property \Carbon\Carbon $expiration_date
 *
 * @property \App\Stock $stock
 * @property \App\Product $product
 * @property \App\CustomerOrderItem $customerOrderItem
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stock()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerOrderItem()
 *
 *
 * @package App
 */
class StockProduct extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'delivery_number',
		'expiration_date',
		'stock_id',
		'product_id',
		'customer_order_item_id',
	];

	protected $casts = [

	];

	protected $dates = [
		'expiration_date',
	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'stock' => \App\Stock::class,
		'product' => \App\Product::class,
		'customerOrderItem' => \App\CustomerOrderItem::class,
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
		'product',
		'customerOrderItem',
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
        $condition = is_resource_page(['stock_product']) || is_datatable(['stock_product']);

        return [
            $condition ? 'stock' : null,
            $condition ? 'product' : null,
            $condition ? 'product.productGroup' : null,
            $condition ? 'customerOrderItem' : null,
        ];
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
        if(is_date($value, 'Y-m-d H:i:s')) {
            $this->attributes['expiration_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        } elseif(is_date($value, 'd/m/Y')) {
            $this->attributes['expiration_date'] = Carbon::createFromFormat('d/m/Y', $value);
        } else {
            $this->attributes['expiration_date'] = null;
        }
    }
}
