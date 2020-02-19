<?php

namespace App;

use Illuminate\Notifications\Notifiable;

/**
 * Customer
 *
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
 * @property boolean $archived
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
 * @property \App\Stock $stock
 * @property \App\CustomerType $customerType
 * @property \App\PaymentType $paymentType
 * @property \App\User $user
 * @property \App\Region $billingRegion
 * @property \App\Region $shippingRegion
 * @property \App\PriceGroup $priceGroup
 * @property \Illuminate\Support\Collection|CustomerOrder[] $customerOrders
 * @property \Illuminate\Support\Collection|CustomerShipment[] $customerShipments
 * @property \Illuminate\Support\Collection|CustomerPricingPolicy[] $customerPricingPolicies
 * @property \Illuminate\Support\Collection|CustomerInvoice[] $customerInvoices
 * @property \Illuminate\Support\Collection|CustomerUser[] $customerUsers
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo stock()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo paymentType()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo billingRegion()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo shippingRegion()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany customerUsers()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo priceGroup()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerOrders()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerShipments()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerPricingPolicies()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerInvoices()
 *
 * @package App
 */
class Customer extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'legal_name',
        'billing_postcode',
        'billing_address',
        'shipping_postcode',
        'shipping_address',
        'y_tunnus',
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
        'stock_id',
        'customer_type_id',
        'payment_type_id',
        'user_id',
        'billing_region_id',
        'shipping_region_id',
        'archived',
        'nr',
        'country',
        'state',
        'post_code',
        'post_office',
        'address1',
        'address2',
        'contact_p',
        'bid',
        'ovt',
        'price_group_id',
    ];

    protected $casts = [
        'order_interval' => 'integer',
        'pays_vat' => 'boolean',
        'archived' => 'boolean',

    ];

    protected $dates = [

    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'stock' => \App\Stock::class,
        'customerType' => \App\CustomerType::class,
        'paymentType' => \App\PaymentType::class,
        'user' => \App\User::class,
        'billingRegion' => \App\Region::class,
        'shippingRegion' => \App\Region::class,
        'priceGroup' => \App\PriceGroup::class,
    ];

    protected $belongsToMany = [
        'customerUsers' => [\App\CustomerUser::class, 'customer_user_customer'],
    ];

    protected $belongsToManyPivot = [

    ];

    protected $belongsToManyPivotTimestamps = [

    ];

    protected $hasOne = [

    ];

    protected $hasMany = [
        'customerOrders' => \App\CustomerOrder::class,
        'customerShipments' => \App\CustomerShipment::class,
        'customerPricingPolicies' => \App\CustomerPricingPolicy::class,
        'customerInvoices' => \App\CustomerInvoice::class,

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
     * @return string
     */
    public function renderName()
    {
        return $this->renderMediaView(
            $this->nr ? sprintf("%s #%d", $this->name, $this->nr) : $this->name,
            sprintf("%s / BID %s / OVT %s", $this->legal_name, $this->bid ?? '—', $this->ovt ?? '—')
        );
    }

    /**
     * @return string
     */
    public function getContentAttribute()
    {
        return $this->renderName();
    }
}
