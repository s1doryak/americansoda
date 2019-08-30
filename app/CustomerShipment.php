<?php

namespace App;

use Carbon\Carbon;

/**
 * CustomerShipment
 *
 * @property string $number
 * @property string $assembly_number
 * @property string $invoice_number
 * @property string $status
 * @property string $delivery_type
 * @property integer $packages_quantity
 * @property string $comment
 * @property \App\PackageType $packageType
 * @property \App\Customer $customer
 * @property \App\User $user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo packageType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user()
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
		'user_id',
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
		'user' => \App\User::class,
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
        'customerOrderItems' => CustomerOrderItem::class,
    ];

    protected $hasManyThrough = [

    ];

    protected $morphTo = [

    ];

    protected $morphMany = [

    ];

    protected $with = [
		'packageType',
		'customer',
		'user',
    ];

    protected $images = [

    ];

    protected $files = [

    ];

    public function getWith()
    {
        $condition = is_resource_page(['customer_shipment']) || is_datatable(['customer_shipment']);

        return [
            $condition ? 'customer' : null,
            $condition ? 'user' : null,
            $condition ? 'packageType' : null,
            $condition ? 'customerOrderItems' : null,
            $condition ? 'customerOrderItems.customerOrder' : null,
            $condition ? 'customerOrderItems.product' : null,
        ];
    }

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
        ];

        $condition = is_resource_page(['customer_shipment']) || is_datatable(['customer_shipment']);

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
        return $this->customerOrderItems->filter(
            function ($item) {
                return !($item->back_order);
            }
        )->pluck('customerOrder.number')
            ->unique()
            ->implode(', ');
    }

    /**
     * @return string
     */
    public function getOrderBatchNumbersAttribute()
    {
        return $this->customerOrderItems->filter(
            function ($item) {
                return !($item->back_order);
            }
        )->pluck('customerOrder.batch_number')
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
            return array_first(array_keys(config('stock.status')));
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
        return $this->assembly_number && $this->assembly_number != self::getDefaultAssemblyNumber();
    }
}
