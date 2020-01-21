<?php

namespace App\Notifications\Api\V1;

use App\Customer;
use App\CustomerPreOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Notification;

/**
 * PreOrderCreate notification.
 *
 * @package App\Notifications\Api\V1
 */
class PreOrderCreate extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Customer $customer
     */
    protected $customer;

    /**
     * @var CustomerPreOrder $customerPreOrder;
     */
    protected $customerPreOrder;

    /**
     * PreOrderCreate constructor.
     * @param Customer $customer
     * @param CustomerPreOrder $customerPreOrder
     */
    public function __construct(
        Customer $customer,
        CustomerPreOrder $customerPreOrder
    )
    {
        $this->customer = $customer;
        $this->customerPreOrder = $customerPreOrder;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('notifications/auth_attempt.subject'))
            ->line(trans('notifications/pre_order_create.message', [
                'customer' => $this->customer->name,
                'pre_order' => $this->customerPreOrder->number
            ]))
            ->action(
                trans('notifications/pre_order_create.show'),
                generatePreOrderLink($this->customerPreOrder->getKey())
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => trans('notifications/pre_order_create.message')
        ];
    }
}