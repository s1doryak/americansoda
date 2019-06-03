<?php

namespace App;

/**
 * CustomerInvoiceItem
 *
 * @property integer $id
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
 * @property \App\CustomerInvoice $invoice
 * @property \App\CustomerOrderItem $orderItem

 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo invoice()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo orderItem()

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
		'invoice_id',
		'order_item_id',
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
		'invoice' => \App\CustomerInvoice::class,
		'orderItem' => \App\CustomerOrderItem::class,
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
		'invoice',
		'orderItem',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}