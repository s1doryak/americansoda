<?php

namespace App;

/**
 * @property string $client_purchase_order
 * @property integer $client_purchase_order_line
 * @property string $product_code
 * @property string $product_ean
 * @property string $product_package_ean
 * @property string $product_name
 * @property string $original_quantity
 * @property string $product_unit
 * @property string $price_per_unit
 * @property string $price_per_unit_with_tax
 * @property string $vat_rate
 * @property string $currency
 * @property string $quantity_in_selling_unit
 * @property string $selling_unit
 * @property string $warehouse
 * @property string $net_weight_unit
 * @property string $processed_quantity
 * @property string $product_group_id
 * @property string $unmodified_original_quantity
 * @property integer $picked
 * @property integer $customer_order_item_id
 * @property LtpTransfer $ltpTransfer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo ltpTransfer()
 *
 * @package App
 */
class LtpTransferItem extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'client_purchase_order',
        'client_purchase_order_line',
        'product_code',
        'product_ean',
        'product_package_ean',
        'product_name',
        'original_quantity',
        'product_unit',
        'price_per_unit',
        'price_per_unit_with_tax',
        'vat_rate',
        'currency',
        'quantity_in_selling_unit',
        'selling_unit',
        'warehouse',
        'net_weight_unit',
        'processed_quantity',
        'product_group_id',
        'unmodified_original_quantity',
        'picked',
        'customer_order_item_id',
        'ltp_transfer_id'
    ];

    protected $casts = [

    ];

    protected $dates = [

    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'ltpTransfer' => \App\LtpTransfer::class
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
}
