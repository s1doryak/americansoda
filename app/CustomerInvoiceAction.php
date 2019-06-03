<?php

namespace App;

/**
 * CustomerInvoiceAction
 *
 * @property integer $id
 * @property string $action
 * @property \Carbon\Carbon $timestamp
 * @property \App\CustomerInvoice $customerInvoice

 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerInvoice()

 * @package App
 */
class CustomerInvoiceAction extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'action',
		'timestamp',
		'customer_invoice_id',
	];

	protected $appends = [

	];

	protected $casts = [

	];

	protected $dates = [
		'timestamp',
	];

    protected $hidden = [

    ];

    protected $belongsTo = [
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

    ];

    protected $hasManyThrough = [

    ];

    protected $morphTo = [

    ];

    protected $morphMany = [

    ];

    protected $with = [
		'customerInvoice',
    ];

    protected $images = [

    ];

    protected $files = [

    ];
}