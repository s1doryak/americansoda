<?php

namespace App;

use Carbon\Carbon;

/**
 * @property string $document_type
 * @property string $document_number
 * @property Carbon $requested_delivery_date
 * @property string $requested_delivery_timestamp
 * @property Carbon|null $document_date
 * @property string $warehouse
 * @property string $comment
 * @property string $owner_reference
 * @property string $invoicing_reference
 * @property string $seller_info
 * @property string $delivery_route
 * @property string $delivery_route_load
 * @property string $delivery_drop
 * @property string $delivery_class
 * @property string $delivery_terminal_info
 * @property string $weight
 * @property string $volume
 * @property string $code
 * @property string $name
 * @property string $address
 * @property string $zip
 * @property string $city
 * @property string $region
 * @property string $country
 * @property string $information
 * @property string $iln
 * @property string $edi_identifier
 * @property string $email
 * @property string $phone
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
        'requested_delivery_timestamp',
        'warehouse',
        'comment',
        'owner_reference',
        'invoicing_reference',
        'seller_info',
        'delivery_route',
        'delivery_route_load',
        'delivery_drop',
        'delivery_class',
        'delivery_terminal_info',
        'weight',
        'volume',
        'code',
        'name',
        'address',
        'zip',
        'city',
        'region',
        'country',
        'information',
        'iln',
        'edi_identifier',
        'email',
        'phone',

    ];

    protected $casts = [

    ];

    protected $dates = [
        'requested_delivery_date',
        'document_date',
        'created_at',
        'updated_at',
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
