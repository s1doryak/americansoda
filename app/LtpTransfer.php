<?php

namespace App;

use Carbon\Carbon;

/**
 * @property string $document_type
 * @property string $document_number
 * @property string $code
 * @property string $name
 * @property string $address
 * @property string $zip
 * @property string $city
 * @property Carbon $requested_delivery_date
 * @property \Illuminate\Support\Collection|\App\LtpTransferItem[] $items
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\HasMany items()
 *
 * @package App
 */
class LtpTransfer extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'document_type',
        'document_number',
        'requested_delivery_date',
        'code',
        'name',
        'address',
        'zip',
        'city',

    ];

    protected $casts = [

    ];

    protected $dates = [

    ];

    protected $hidden = [

    ];

    protected $belongsTo = [

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
        'items' => LtpTransferItem::class,
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
}
