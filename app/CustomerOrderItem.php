<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Arr;

/**
 * CustomerOrderItem
 *
 * @property string $status
 * @property string $product_name
 * @property float $sales_unit_quantity
 * @property boolean $product_manual_price
 * @property float $product_price
 * @property integer $vat
 * @property float $product_vat_price
 * @property integer $products_quantity
 * @property integer $packages_quantity
 * @property float $total_price
 * @property float $total_vat_price
 * @property boolean $deposit_enabled
 * @property float $deposit_price
 * @property integer $deposit_vat
 * @property float $deposit_vat_price
 * @property float $deposit_total_price
 * @property float $deposit_total_vat
 * @property float $deposit_total_vat_price
 * @property boolean $bypass
 * @property boolean $back_order
 * @property boolean $cancelled
 * @property \Illuminate\Support\Carbon|null $expected_date
 * @property \App\Product $product
 * @property \App\Customer $customer
 * @property \App\CustomerOrder $customerOrder
 * @property \App\CustomerShipment $customerShipment
 * @property \App\CustomerInvoice $customerInvoice
 * @property \Illuminate\Support\Collection|\App\StockProduct[] $stockProducts
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo product()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerOrder()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerShipment()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerInvoice()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany stockProducts()
 *
 * @package App
 */
class CustomerOrderItem extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'status',
        'product_name',
        'sales_unit_quantity',
        'product_manual_price',
        'product_price',
        'vat',
        'product_vat_price',
        'products_quantity',
        'packages_quantity',
        'total_price',
        'total_vat_price',
        'deposit_enabled',
        'deposit_price',
        'deposit_vat',
        'deposit_vat_price',
        'deposit_total_price',
        'deposit_total_vat',
        'deposit_total_vat_price',
        'bypass',
        'back_order',
        'cancelled',
        'expected_date',
        'product_id',
        'customer_id',
        'customer_order_id',
        'customer_shipment_id',
        'customer_invoice_id',
    ];

    protected $casts = [
        'sales_unit_quantity' => 'float',
        'product_manual_price' => 'boolean',
        'product_price' => 'float',
        'vat' => 'integer',
        'product_vat_price' => 'float',
        'products_quantity' => 'integer',
        'packages_quantity' => 'integer',
        'total_price' => 'float',
        'total_vat_price' => 'float',
        'deposit_enabled' => 'boolean',
        'deposit_price' => 'float',
        'deposit_vat' => 'integer',
        'deposit_vat_price' => 'float',
        'deposit_total_price' => 'float',
        'deposit_total_vat' => 'float',
        'deposit_total_vat_price' => 'float',
        'bypass' => 'boolean',
        'back_order' => 'boolean',
        'cancelled' => 'boolean',
    ];

    protected $dates = [
        'expected_date',
    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'product' => \App\Product::class,
        'customer' => \App\Customer::class,
        'customerOrder' => \App\CustomerOrder::class,
        'customerShipment' => \App\CustomerShipment::class,
        'customerInvoice' => \App\CustomerInvoice::class,
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
        'stockProducts' => StockProduct::class,
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
     * @param $value
     */
    public function setSalesUnitQuantityAttribute($value)
    {
        $this->attributes['sales_unit_quantity'] = floatize($value);
    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        $status = $this->attributes['status'];

        if ($status === null) {
            return Arr::first(array_keys(config('stock.status')));
        }

        return strtolower($status);
    }

    /**
     * @return string
     */
    public function getExpectedDateAttribute()
    {
        return ''; // $this->formatDateForForm('expected_date');
    }

    /**
     * @return integer|null
     */
    public function getExpectedWeekAttribute()
    {
        if ($this->attributes['expected_date'] === null) {
            return null;
        }

        return Carbon::parse($this->attributes['expected_date'])->weekOfYear;
    }

    /**
     * @return mixed
     */
    public function getDeliveryNumbersAttribute()
    {
        return get_delivery_numbers($this->getKey());
    }

    /**
     * @return boolean
     */
    public function hasValidAssemblyNumber()
    {
        return $this->customerShipment && $this->customerShipment->hasValidAssemblyNumber();
    }

    /**
     * @return boolean
     */
    public function hasDefaultAssemblyNumber()
    {
        return $this->customerShipment && $this->customerShipment->hasDefaultAssemblyNumber();
    }

    /**
     * @return string
     */
    public function getAssemblyNumber()
    {
        return $this->customerShipment ? $this->customerShipment->assembly_number : '';
    }
}
