<?php

namespace App\Notifications\Api\V1;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuthAttemptFailed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * AuthFailedAttempt constructor.
     * @param string $email
     */
    public function __construct($email)
    {
        $this->email = $email;
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
            ->subject(trans('notifications/auth_attempt_failed.subject'))
            ->cc(config('mail.from.address'), config('mail.from.name'))
            ->line(trans('notifications/auth_attempt_failed.message', [
                'email' => $this->email,
            ]));
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
            'message' => trans('notifications/auth_attempt_failed.message')
        ];
    }
}