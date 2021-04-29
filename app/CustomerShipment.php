<?php

namespace App;

use App\Transformers\Dashboard\CustomerOrderItemTransformer;
use Carbon\Carbon;
use Illuminate\Support\Arr;

/**
 * CustomerShipment
 *
 * @property string $number
 * @property string $assembly_number
 * @property string $invoice_number
 * @property string $status
 * @property string $delivery_type
 * @property string $delivery_date
 * @property string $delivery_month
 * @property integer $packages_quantity
 * @property string $comment
 * @property string $order_numbers
 * @property string $order_batch_numbers
 * @property \App\PackageType $packageType
 * @property \App\Customer $customer
 * @property \App\CustomerInvoice $customerInvoice
 * @property \App\LtpTransfer $ltpTransfer
 * @property \Illuminate\Support\Collection|\App\CustomerOrderItem[] $customerOrderItems
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo packageType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user()
 * @method \Illuminate\Database\Eloquent\Relations\HasOne customerInvoice()
 * @method \Illuminate\Database\Eloquent\Relations\HasOne ltpTransfer()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerOrderItems()
 *
 * @package App
 */
class CustomerShipment extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'number',
        'assembly_number',
        'invoice_number',
        'status',
        'delivery_type',
        'packages_quantity',
        'comment',
        'package_type_id',
        'customer_id',
    ];

    protected $casts = [
        'packages_quantity' => 'integer',
    ];

    protected $dates = [

    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'packageType' => \App\PackageType::class,
        'customer' => \App\Customer::class,
    ];

    protected $belongsToMany = [

    ];

    protected $belongsToManyPivot = [

    ];

    protected $belongsToManyPivotTimestamps = [

    ];

    protected $hasOne = [
        'customerInvoice' => \App\CustomerInvoice::class,
        'ltpTransfer' => \App\LtpTransfer::class,
    ];

    protected $hasMany = [
        'customerOrderItems' => \App\CustomerOrderItem::class,
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
     * Get all of the appendable values that are arrayable.
     *
     * @return array
     */
    protected function getArrayableAppends()
    {
        $this->appends = [
            'delivery_date',
            'delivery_month',
            'amount'
        ];

        $condition = is_resource_page(['customer_shipment']) || is_datatable(['customer_shipment']) || is_api();

        if ($condition) {
            $this->appends = array_merge(
                $this->appends,
                [
                    'order_numbers',
                    'order_batch_numbers',
                ]
            );
        }

        if (!count($this->appends)) {
            return [];
        }

        return $this->getArrayableItems(
            array_combine($this->appends, $this->appends)
        );
    }

    /**
     * @param $value
     * @return string
     */
    public function getAmountAttribute($value)
    {
        $palpa = CustomerOrderItemTransformer::mapCustomerInvoicePalpaItemsArray($this->customerOrderItems);

        return number_format(
            $this->customerOrderItems->sum('total_price') + $this->customerOrderItems->sum('deposit_total_price') + $palpa->sum('price'),
            2,
            '.',
            ''
        );
    }

    /**
     * @return string
     */
    public function getContentAttribute()
    {
        return $this->renderMediaView(
            $this->number,
            sprintf("%s / %s", optional($this->customer)->name ?? '—', $this->assembly_number)
        );
    }

    /**
     * @return string
     */
    public function getOrderNumbersAttribute()
    {
        #todo: проверить отношения
        return $this->customerOrderItems
            ->map(function (CustomerOrderItem $customerOrderItem) {
                return !$customerOrderItem->back_order && $customerOrderItem->customerOrder
                    ? $customerOrderItem->customerOrder->number
                    : null;
            })
            ->unique()
            ->implode(', ');
    }

    /**
     * @return string
     */
    public function getOrderBatchNumbersAttribute()
    {
        return $this->customerOrderItems
            ->map(function (CustomerOrderItem $customerOrderItem) {
                return !$customerOrderItem->back_order && $customerOrderItem->customerOrder
                    ? $customerOrderItem->customerOrder->batch_number
                    : null;
            })
            ->unique()
            ->implode(', ');
    }

    /**
     * @return string|null
     */
    public function getDeliveryDateAttribute()
    {
        $matches = [];

        preg_match_all('/(\d{4}).*(\d{2})(\d{2})/', $this->attributes['number'], $matches);

        if (count($matches) && isset($matches[1]) && is_array($matches[1]) && !empty($matches[1])) {
            $date = sprintf('%d-%d-%d', $matches[1][0], $matches[2][0], $matches[3][0]);

            return Carbon::parse($date)->format('d.m.Y');
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getDeliveryMonthAttribute()
    {
        if ($this->delivery_date === null) {
            return null;
        }

        return Carbon::parse($this->delivery_date)->format('d.m');
    }

    /**
     * @return string|null
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
     * @param $value
     */
    public function setPackageTypeIdAttribute($value)
    {
        if (empty($value)) {
            $value = null;
        }

        $this->attributes['package_type_id'] = $value;
    }

    /**
     * @return string
     */
    public static function getDefaultNumber()
    {
        return sprintf('%04d-TRS-%02d%02d', Carbon::now()->year, Carbon::now()->month, Carbon::now()->day);
    }

    /**
     * @return string
     */
    public static function getDefaultAssemblyNumber()
    {
        return sprintf('%04d-KERÄYS-TEMP', Carbon::now()->year);
    }

    /**
     * @return string
     */
    public function getCustomerShipmentStorageFilename()
    {
        return preg_replace('/\s+/mui', '_', sprintf('%s_%s_%s', $this->id, $this->number, mb_strtoupper('Rahtikirja')));
    }

    /**
     * @return boolean
     */
    public function hasValidAssemblyNumber()
    {
        return $this->assembly_number && $this->assembly_number != self::getDefaultAssemblyNumber();
    }

    /**
     * @return boolean
     */
    public function hasDefaultAssemblyNumber()
    {
        return $this->assembly_number && $this->assembly_number == self::getDefaultAssemblyNumber();
    }
}
