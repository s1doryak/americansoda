<?php

namespace App;

use Illuminate\Support\Arr;

/**
 * CustomerRevision
 *
 * @property string $revision_type
 * @property boolean $archived
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
 * @property \App\PriceGroup|null $priceGroup
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo revision()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo editor()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stock()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo paymentType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo billingRegion()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo shippingRegion()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo priceGroup()
 *
 * @property string $nr
 * @property string $country
 * @property string $state
 * @property string $post_code
 * @property string $post_office
 * @property string $address1
 * @property string $address2
 * @property string $contact_p
 * @property string $ovt
 * @property string $y_tunnus
 * @package App
 */
class CustomerRevision extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    const REV_CREATED = 'created';
    const REV_EDITED = 'edited';
    const REV_COMMENTED = 'commented';
    const REV_DESTROYED = 'destroyed';
    const REV_TRASHED = 'trashed';

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
        'price_group_id',
		'nr',
		'country',
		'state',
		'post_code',
		'post_office',
		'address1',
		'address2',
		'contact_p',
		'ovt',
		'y_tunnus',
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
        'revision' => [\App\CustomerRevision::class, 'revision_id'],
        'editor' => [\App\User::class, 'editor_id'],
        'stock' => [\App\Stock::class, 'stock_id'],
        'customerType' => [\App\CustomerType::class, 'customer_type_id'],
        'paymentType' => [\App\PaymentType::class, 'payment_type_id'],
        'user' => [\App\User::class, 'user_id'],
        'billingRegion' => [\App\Region::class, 'billing_region_id'],
        'shippingRegion' => [\App\Region::class, 'shipping_region_id'],
        'priceGroup' => [\App\PriceGroup::class, 'price_group_id'],
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
        'revision',
        'editor',
        'stock',
        'customerType',
        'paymentType',
        'user',
        'billingRegion',
        'shippingRegion',
        'priceGroup',
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

        return Arr::where($current, function ($value, $attr) use ($parent) {
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
            'price_group_id',
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

        return Arr::except($attributes, $ignored);
    }
}
