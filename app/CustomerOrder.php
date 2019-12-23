<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

/**
 * CustomerOrder
 *
 * @property string $number
 * @property string $batch_number
 * @property string $comment
 * @property integer $fc_overdue
 * @property string $fc_comment
 * @property string $fc_future_comment
 * @property \Illuminate\Support\Carbon|null $sent_at
 * @property \App\Customer $customer
 * @property \App\User $user
 * @property \Illuminate\Support\Collection|\App\CustomerOrderItem[] $customerOrderItems
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo customer()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany customerOrderItems()
 *
 * @package App
 */
class CustomerOrder extends \Crmplease\MaterialAdmin\Database\Eloquent\Model
{
    protected $fillable = [
        'number',
        'batch_number',
        'comment',
        'fc_overdue',
        'fc_comment',
        'fc_future_comment',
        'sent_at',
        'customer_id',
        'user_id',
    ];

    protected $casts = [
        'fc_overdue' => 'integer',
    ];

    protected $dates = [
        'sent_at',
    ];

    protected $appends = [
        'status',
        'amount',
        'amount_vat',
    ];

    protected $hidden = [

    ];

    protected $belongsTo = [
        'customer' => \App\Customer::class,
        'user' => \App\User::class,
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
        'customerOrderItems' => CustomerOrderItem::class,
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
     * @param $value
     * @return string
     */
    public function getStatusAttribute($value)
    {
        $statuses = array_keys(config('stock.status'));

        $status = $this->customerOrderItems->map(
            function ($customerOrderItem) use ($statuses) {
                return array_search($customerOrderItem->status, $statuses);
            }
        )->max();

        return isset($statuses[$status]) ? $statuses[$status] : 'open';
    }

    public function getAmountAttribute($value)
    {
        return number_format(
            $this->customerOrderItems->sum('total_price'),
            2,
            '.',
            ''
        );
    }

    public function getAmountVatAttribute($value)
    {
        return number_format(
            $this->customerOrderItems->sum('total_vat_price'),
            2,
            '.',
            ''
        );
    }

    /**
     * @return string
     */
    public function getEmailSubject()
    {
        return $this->getOrderReviewFileName();
    }

    /**
     * @return string
     */
    public function getOrderReviewFileName()
    {
        return preg_replace(
            '/\s+/mui',
            '_',
            sprintf('%s_%s_%s', $this->number, $this->customer->name, mb_strtoupper('Tilausvahvistus'))
        );
    }

    /**
     * @return string
     */
    public function getOrderReviewStorageFileName()
    {
        return preg_replace('/\s+/mui', '_', sprintf('%s_%s', $this->number, mb_strtoupper('Tilausvahvistus')));
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return route('dashboard.customer_order.edit', $this->getKey());
    }

    /**
     * @return Carbon
     */
    public function getDate()
    {
        if (preg_match('/[a-zA-Z\-]*([0-9]{4})([0-9]{2})([0-9]{2})[0-9\-]*/mui', $this->number, $matches)) {
            $date = Carbon::createFromFormat('d/m/Y', sprintf('%s/%s/%s', $matches[3], $matches[2], $matches[1]));
        } else {
            $date = $this->created_at;
        }

        return $date;
    }

    /**
     * @return mixed
     */
    public function getFcId()
    {
        return $this->getKey();
    }

    /**
     * @return string
     */
    public function getFcTitle()
    {
        if ($this->customer) {
            return $this->customer->name;
        }

        return $this->number;
    }

    /**
     * @return string
     */
    public function getFcStartDate()
    {
        $date = $this->getDate();

        return $date->toIso8601String();
    }

    /**
     * @return boolean
     */
    public function getFcAllDay()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getFcClassName()
    {
        /** @var Customer|null $customer */
        $customer = $this->customer;

        $classes = [];

        $classes[] = sprintf('fc-order-status-%s', $this->status);

        if (!empty(trim(strip_tags($this->fc_comment)))) {
            $classes[] = 'fc-order-has-comment';
        }

        if ($customer && !empty(trim(strip_tags($customer->calendar_comment)))) {
            $classes[] = 'fc-order-has-comment';
        }

        return collect($classes)->implode(' ');
    }

    /**
     * @return string
     */
    public function getFcComment()
    {
        /** @var Customer|null $customer */
        $customer = $this->customer;

        if ($customer) {
            return (string)$customer->calendar_comment;
        }

        return (string)$this->fc_comment;
    }

    /**
     * @return string
     */
    public function getFcFutureComment()
    {
        /** @var Customer|null $customer */
        $customer = $this->customer;

        if ($customer) {
            return (string)$customer->calendar_comment;
        }

        return (string)$this->fc_future_comment;
    }

    /**
     * @return integer
     */
    public function getFcOverdue()
    {
        return (int)$this->fc_overdue;
    }

    /**
     * @return array
     */
    public function getFcDescription()
    {
        $description = [
            'order_url' => route('dashboard.customer_order.edit', $this->getRouteKey()),
            'order_number' => $this->number,
            'order_status' => trans(sprintf('models/customer_order.statuses.%s', $this->status))
        ];

        /** @var Customer|null $customer */
        $customer = $this->customer;

        if ($customer) {
            $description['customer_url'] = route('dashboard.customer.edit', $customer->getRouteKey());
            $description['customer_name'] = sprintf('%s / %s', $customer->name, $customer->legal_name);
            $description['customer_address'] = sprintf('%s, %s', $customer->shipping_address, $customer->shipping_postcode);
            $description['customer_phone'] = $customer->phone;
            $description['customer_email'] = $customer->email;
        }

        return $description;
    }

    /**
     * @return array
     */
    public function toFcEvent()
    {
        return [
            'type' => 'order',
            'editable' => false,
            'durationEditable' => false,
            'order' => $this->getKey(),
            'title' => $this->getFcTitle(),
            'comment' => $this->getFcComment(),
            'future_comment' => $this->getFcFutureComment(),
            'description' => $this->getFcDescription(),
            'start' => $this->getFcStartDate(),
            'overdue' => $this->getFcOverdue(),
            'allDay' => $this->getFcAllDay(),
            'className' => $this->getFcClassName(),
        ];
    }

    /**
     * @param $attachment
     * @return boolean
     */
    public function sendEmail($attachment)
    {
        try {

            /** @var CustomerOrder $order */
            $order = $this;

            Mail::send(
                'dashboard::resources.customer.mail.order_review',
                ['order' => $order],

                function (Message $message) use ($order, $attachment) {

                    /** @var Customer $customer */
                    $customer = $order->customer;

                    $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'))
                        ->to($customer->email, $customer->name)
                        ->cc(env('MAIL_FROM'), env('MAIL_FROM_NAME'))
                        ->subject($order->getEmailSubject())
                        ->attach(
                            $attachment,
                            [
                                'as' => sprintf('%s.pdf', $order->getOrderReviewFileName()),
                                'mime' => 'application/pdf',
                            ]
                        );

                }
            );

        } catch (\Swift_TransportException $e) {
        }

        return true;
    }
}
