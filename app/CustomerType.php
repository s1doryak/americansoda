<?php

namespace App;

/**
 * CustomerType
 *
 * @property string $name
 *
 * @property \App\CustomerType $customerType
 *
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerType()
 *
 *
 * @package App
 */
class CustomerType extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'name',
        'customer_type_id',
    ];

    protected $casts = [

    ];

    protected $dates = [

    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'customerType' => \App\CustomerType::class,
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
        'customerType',
    ];

    protected $images = [

    ];

    protected $files = [

    ];

    /**
     * @return array
     */
    public function getWith()
    {
        $condition = is_resource_page(['customer_type']) || is_datatable(['customer_type']);

        return [
            $condition ? 'customerType' : null,
        ];
    }
}
