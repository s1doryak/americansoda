<?php

namespace App;

/**
 * CustomerInvoice
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $customer_shipment_id
 *
 * @property string $maventa_id
 * @property \Crmplease\MaterialAdmin\Database\Eloquent\Traits\File\FileField $maventa_tiff
 * @property boolean $maventa_initiated
 * @property boolean $maventa_paid
 * @property \Illuminate\Support\Carbon|null $maventa_sent_at
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
 * @property string $customer_reference
 * @property \App\Customer $customer
 * @property \App\CustomerShipment $customerShipment
 * @property \Illuminate\Support\Collection|\App\CompanyBankAccount[] $companyBankAccounts
 * @property \Illuminate\Support\Collection|\App\CustomerInvoiceItem[] $customerInvoiceItems
 * @property \Illuminate\Support\Collection|\App\CustomerInvoiceAction[] $customerInvoiceActions
 * @property \Illuminate\Support\Collection|\App\CustomerInvoiceAttachment[] $customerInvoiceAttachments
 * @property \Illuminate\Support\Collection|\App\CustomerOrderItem[] $customerOrderItems
 *
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customerShipment()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany companyBankAccounts()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerInvoiceItems()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerInvoiceActions()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerInvoiceAttachments()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerOrderItems()
 *
 * @package App
 */
class CustomerInvoice extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'customer_id',
        'customer_shipment_id',

        'maventa_id',
        'maventa_tiff',
        'maventa_initiated',
        'maventa_paid',
        'maventa_sent_at',

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
		'customer_reference',
    ];

    protected $appends = [

    ];

    protected $casts = [
        'maventa_initiated' => 'boolean',
        'state' => 'integer',
		'maventa_paid' => 'boolean',
    ];

    protected $dates = [
		'maventa_sent_at',
	];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'customer' => \App\Customer::class,
        'customerShipment' => \App\CustomerShipment::class,
    ];

    protected $belongsToMany = [
        'companyBankAccounts' => [\App\CompanyBankAccount::class, 'customer_invoice_company_bank_account'],
    ];

    protected $belongsToManyPivot = [

    ];

    protected $belongsToManyPivotTimestamps = [

    ];

    protected $hasOne = [

    ];

    protected $hasMany = [
        'customerInvoiceItems' => \App\CustomerInvoiceItem::class,
        'customerInvoiceActions' => \App\CustomerInvoiceAction::class,
        'customerInvoiceAttachments' => \App\CustomerInvoiceAttachment::class,
        'customerOrderItems' => \App\CustomerOrderItem::class,
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
        'maventa_tiff',
    ];

    /**
     * @return string
     */
    public function generateReferenceNumber()
    {
        $number = $this->order_nr;

        if ($this->customer) {
            $number = sprintf("%s %s", $this->customer->nr, $this->invoice_nr);
        }

        return sprintf("%s%s", $number, viitenumero_check_digit($number));
    }

    /**
     * @return string|
     */
    public function getInvoiceFileName()
    {
        return preg_replace(
            '/\s+/mui',
            '_',
            sprintf('lasku_%d', $this->invoice_nr)
        );
    }

    /**
     * @return string
     */
    public function getInvoiceStorageFileName()
    {
        return preg_replace('/\s+/mui', '_', sprintf('%s_%s_%s', $this->id, $this->invoice_nr, mb_strtoupper('Lasku')));
    }
}
