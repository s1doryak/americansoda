<?php

namespace App\Notifications\Dashboard;

use App\CustomerOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * SendEmail Notification
 *
 * @package App\Notifications\Dashboard
 */
class SendEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var string
     */
    protected $as;

    /**
     * @var CustomerOrder $order
     */
    protected $order;

    /**
     * AccountingReports constructor.
     * @param $file
     * @param $as
     * @param CustomerOrder $order
     */
    public function __construct($file, $as, CustomerOrder $order)
    {
        $this->file = $file;
        $this->as = $as;
        $this->order = $order;
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
            ->subject($this->order->getEmailSubject())
            ->cc(config('mail.from.address'), config('mail.from.name'))
            ->line(trans('notifications/send_email.message'))
            ->attach($this->file, [
                'as' => $this->as,
                'mime' => 'application/pdf',
            ]);
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
            'message' => trans('notifications/send_email.message')
        ];
    }
}
