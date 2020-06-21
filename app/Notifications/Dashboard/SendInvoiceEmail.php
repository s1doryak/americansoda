<?php

namespace App\Notifications\Dashboard;

use App\CustomerInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendInvoiceEmail extends Notification implements ShouldQueue
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
     * @var CustomerInvoice $invoice
     */
    protected $invoice;

    /**
     * SendInvoiceEmail constructor.
     * @param $file
     * @param $as
     * @param CustomerInvoice $invoice
     */
    public function __construct($file, $as, CustomerInvoice $invoice)
    {
        $this->file = $file;
        $this->as = $as;
        $this->invoice = $invoice;
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
            ->subject($this->invoice->getInvoiceFileName())
            ->cc(config('mail.from.address'), config('mail.from.name'))
            ->line(trans('notifications/send_invoice_email.message'))
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
            'message' => trans('notifications/send_invoice_email.message')
        ];
    }
}
