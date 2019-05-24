<?php

namespace App;

/**
 * CustomerRevision
 *
 * @property string $revision_type
 * @property string $name
 * @property string $legal_name
 * @property string $billing_postcode
 * @property string $billing_address
 * @property string $shipping_postcode
 * @property string $shipping_address
 * @property string $bid
 * @property string $iban
 * @property string $swift
 * @property string $email
 * @property string $phone
 * @property integer $order_interval
 * @property string $comment
 * @property string $calendar_comment
 * @property string $incomterms
 * @property string $terms_of_cooperation
 * @property string $terms_of_delivery
 * @property string $terms_of_equipment
 * @property string $delivery_payer
 * @property string $payment_conditions
 * @property boolean $pays_vat
 *
 * @property \App\CustomerRevision $revision
 * @property \App\User $editor
 * @property \App\Stock $stock
 * @property \App\CustomerType $customerType
 * @property \App\PaymentType $paymentType
 * @property \App\User $user
 * @property \App\Region $billingRegion
 * @property \App\Region $shippingRegion
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo revision()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo editor()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stock()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo paymentType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo billingRegion()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo shippingRegion()
 *
 *
 * @package App
 */
class CustomerRevision extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'revision_type',
        'name',
        'legal_name',
        'billing_postcode',
        'billing_address',
        'shipping_postcode',
        'shipping_address',
        'bid',
        'iban',
        'swift',
        'email',
        'phone',
        'order_interval',
        'comment',
        'calendar_comment',
        'incomterms',
        'terms_of_cooperation',
        'terms_of_delivery',
        'terms_of_equipment',
        'delivery_payer',
        'payment_conditions',
        'pays_vat',
        'revision_id',
        'editor_id',
        'stock_id',
        'customer_type_id',
        'payment_type_id',
        'user_id',
        'billing_region_id',
        'shipping_region_id',
    ];

    protected $casts = [
        'order_interval' => 'integer',
        'pays_vat' => 'boolean',
    ];

    protected $dates = [

    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'revision' => \App\CustomerRevision::class,
        'editor' => \App\User::class,
        'stock' => \App\Stock::class,
        'customerType' => \App\CustomerType::class,
        'paymentType' => \App\PaymentType::class,
        'user' => \App\User::class,
        'billingRegion' => \App\Region::class,
        'shippingRegion' => \App\Region::class,
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
        'revision',
        'editor',
        'stock',
        'customerType',
        'paymentType',
        'user',
        'billingRegion',
        'shippingRegion',
    ];

    protected $images = [

    ];

    protected $files = [

    ];

    /**
     * @return array
     */
    public function getChangedAttributes()
    {
        $current = $this->cleanAttributes($this->toArray());

        if (!$this->revision) {
            return $current;
        }

        $parent = $this->cleanAttributes($this->revision->toArray());

        if ($parent === null) {
            return $current;
        }

        return array_where($current, function ($value, $attr) use ($parent) {
            return $parent[$attr] != $value;
        });
    }

    /**
     * @param array $attributes
     * @return array
     */
    private function cleanAttributes(array $attributes)
    {
        $ignored = [
            'id',
            'created_at',
            'updated_at',
            'created_date',
            'updated_date',
            'revision',
            'revision_id',
            'billing_region_id',
            'shipping_region_id',
            'customer_type_id',
            'payment_type_id',
            'user_id',
            'editor_id',
            'customer_id',
            'stock_id',
            'trashed',
            'revision_type'
        ];

        if (empty($attributes['deleted_at'])) {
            $ignored[] = 'deleted_at';
        }

        return array_except($attributes, $ignored);
    }
}
