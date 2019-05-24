<?php

namespace App;

/**
 * CustomerPricingPolicyRevision
 *
 * @property string $revision_type
 * @property integer $revision_number
 * @property integer $products_range
 * @property float $price
 *
 * @property \App\CustomerPricingPolicyRevision $revision
 * @property \App\CustomerPricingPolicy $customerPricingPolicy
 * @property \App\User $editor
 * @property \App\ProductGroup $productGroup
 * @property \App\Customer $customer
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo revision()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerPricingPolicy()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo editor()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo productGroup()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 *
 *
 * @package App
 */
class CustomerPricingPolicyRevision extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'revision_type',
        'revision_number',
        'products_range',
        'price',
        'revision_id',
        'customer_pricing_policy_id',
        'editor_id',
        'product_group_id',
        'customer_id',
    ];

    protected $casts = [
        'revision_number' => 'integer',
        'products_range' => 'integer',
        'price' => 'float',
    ];

    protected $dates = [

    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'revision' => \App\CustomerPricingPolicyRevision::class,
        'customerPricingPolicy' => \App\CustomerPricingPolicy::class,
        'editor' => \App\User::class,
        'productGroup' => \App\ProductGroup::class,
        'customer' => \App\Customer::class,
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
        'customerPricingPolicy',
        'editor',
        'productGroup',
        'customer',
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
        $accepted = [
            'products_range',
            'price',
            'deleted_at'
        ];

        return array_only($attributes, $accepted);
    }
}
