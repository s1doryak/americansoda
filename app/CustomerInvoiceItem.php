<?php

namespace App;

/**
 * CustomerInvoiceItem
 *
 * @property integer $id
 * @property integer $customer_invoice_id
 * @property integer $customer_order_item_id
 * @property integer $position
 * @property string $item_code
 * @property string $subject
 * @property string $definition
 * @property string $price
 * @property string $unit_type
 * @property string $amount
 * @property string $sum
 * @property string $tax
 * @property string $sum_tax
 * @property string $discount
 * @property \App\CustomerInvoice|null $customerInvoice
 * @property \App\CustomerOrderItem|null $customerOrderItem
 * @property \App\Product|null $product
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerInvoice()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerOrderItem()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()
 *
 * @package App
 */
class CustomerInvoiceItem extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'position',
        'item_code',
        'subject',
        'definition',
        'price',
        'unit_type',
        'amount',
        'sum',
        'tax',
        'sum_tax',
        'discount',
        'customer_invoice_id',
        'customer_order_item_id',
        'product_id',
    ];

    protected $appends = [

    ];

    protected $casts = [
        'position' => 'integer',
        'amount' => 'float',
        'tax' => 'float',
        'discount' => 'float',
    ];

    protected $dates = [

    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'customerInvoice' => \App\CustomerInvoice::class,
        'customerOrderItem' => \App\CustomerOrderItem::class,
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
        'customerInvoice',
        'customerOrderItem',
        'product',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}
