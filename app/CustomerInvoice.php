<?php

namespace App;

/**
 * CustomerInvoice
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $shipment_id
 *
 * @property string $maventa_id
 * @property \Crmplease\MaterialAdmin\Database\Eloquent\Traits\File\FileField $maventa_tiff
 * @property boolean $maventa_initiated
 *
 * @property string $currency
 * @property string $data
 * @property string $date
 * @property string $date_due
 * @property string $delivery_date
 * @property string $delivery_type
 * @property string $error_message
 * @property string $invoice_delivery_address
 * @property string $invoice_nr
 * @property string $invoice_seller_information
 * @property string $lang
 * @property string $notes
 * @property string $order_nr
 * @property string $payment_terms
 * @property string $reference_nr
 * @property integer $state
 * @property string $status
 * @property string $sum
 * @property string $sum_tax
 * @property string $work_order_nr
 * @property string $company_interest
 * @property string $company_paper_fee
 * @property string $company_reminder
 * @property string $company_comment
 * @property string $company_reference
 * @property string $customer_nr
 * @property string $customer_email
 * @property string $customer_name
 * @property string $customer_country
 * @property string $customer_state
 * @property string $customer_post_code
 * @property string $customer_post_office
 * @property string $customer_address1
 * @property string $customer_address2
 * @property string $customer_contact_p
 * @property string $customer_bid
 * @property string $customer_ovt
 * @property \App\Customer $customer
 * @property \App\CustomerShipment $shipment
 * @property \Illuminate\Support\Collection|\App\CompanyBankAccount[] $accounts
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo shipment()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany accounts()
 *
 * @package App
 */
class CustomerInvoice extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
	protected $fillable = [
        'customer_id',
        'shipment_id',

		'maventa_id',
		'maventa_tiff',
		'maventa_initiated',

		'currency',
		'data',
		'date',
		'date_due',
		'delivery_date',
		'delivery_type',
		'error_message',
		'invoice_delivery_address',
		'invoice_nr',
		'invoice_seller_information',
		'lang',
		'notes',
		'order_nr',
		'payment_terms',
		'reference_nr',
		'state',
		'status',
		'sum',
		'sum_tax',
		'work_order_nr',
		'company_interest',
		'company_paper_fee',
		'company_reminder',
		'company_comment',
		'company_reference',
		'customer_nr',
		'customer_email',
		'customer_name',
		'customer_country',
		'customer_state',
		'customer_post_code',
		'customer_post_office',
		'customer_address1',
		'customer_address2',
		'customer_contact_p',
		'customer_bid',
		'customer_ovt',
	];

	protected $appends = [

	];

	protected $casts = [
		'maventa_initiated' => 'boolean',
		'state' => 'integer',
	];

	protected $dates = [

	];

    protected $hidden = [

    ];

    protected $belongsTo = [
		'customer' => \App\Customer::class,
		'shipment' => \App\CustomerShipment::class,
    ];

    protected $belongsToMany = [
		'accounts' => [\App\CompanyBankAccount::class, 'customer_invoice_account'],
    ];

    protected $belongsToManyPivot = [

    ];

    protected $belongsToManyPivotTimestamps = [

    ];

    protected $hasOne = [

    ];

    protected $hasMany = [
		'items' => \App\CustomerInvoiceItem::class,
		'actions' => \App\CustomerInvoiceAction::class,
		'attachments' => \App\CustomerInvoiceAttachment::class,
		'orderItems' => \App\CustomerOrderItem::class,
    ];

    protected $hasManyThrough = [

    ];

    protected $morphTo = [

    ];

    protected $morphMany = [

    ];

    protected $with = [
		'customer',
		'shipment',
		'accounts',
    ];

    protected $images = [

    ];

    protected $files = [
		'maventa_tiff',
    ];
}
