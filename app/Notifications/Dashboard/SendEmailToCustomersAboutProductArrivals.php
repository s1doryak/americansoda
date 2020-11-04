<?php

namespace App\Notifications\Dashboard;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class SendEmailToCustomersAboutProductArrivals extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Collection|Product[]
     */
    protected $products;

    /**
     * @var integer
     */
    protected $customerUser;

    public function __construct($products, $customerUser)
    {
        $this->products = $products;
        $this->customerUser = $customerUser;
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
        $mail = (new MailMessage)
            ->subject(trans('notifications/send_email_to_customers_about_product_arrivals.subject'))
            ->cc(config('mail.from.address'), config('mail.from.name'))
            ->line(trans('notifications/send_email_to_customers_about_product_arrivals.message'));

        foreach ($this->products as $product) {
            $mail->line("- {$product->name}");
            $mail->attach(public_path() . $product->product_image, [
                'mime' => 'image/png',
                'as' => "{$product->name}.png"
            ]);
        }

        return $mail->action(
            trans('notifications/send_email_to_customers_about_product_arrivals.action'),
            route('redirect', ['to' => generateApiAuthLink($this->customerUser)])
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
            'message' => trans('notifications/send_email_to_customers_about_product_arrivals.message')
        ];
    }
}
