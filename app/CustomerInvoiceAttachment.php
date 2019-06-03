<?php

namespace App;

/**
 * CustomerInvoiceAttachment
 *
 * @property integer $id
 * @property string $attachment_type
 * @property string $filename
 * @property string $file
 * @property \App\CustomerInvoice $customerInvoice
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerInvoice()
 *
 * @package App
 */
class CustomerInvoiceAttachment extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
		'attachment_type',
		'filename',
		'file',
		'customer_invoice_id',
	];

	protected $appends = [

	];

	protected $casts = [

	];

	protected $dates = [

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