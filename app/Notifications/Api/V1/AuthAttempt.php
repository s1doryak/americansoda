<?php

namespace App\Notifications\Api\V1;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * AuthAttempt notification.
 *
 * @package App\Notifications\Api\V1
 */
class AuthAttempt extends Notification implements ShouldQueue
{
    use Queueable;

    protected $token;

    /**
     * AuthAttempt constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $url = config('app.url') . '/auth/' . $this->token;

        return (new MailMessage)
            ->subject(trans('notifications/auth_attempt.subject'))
            ->line(trans('notifications/auth_attempt.message'))
            ->action(trans('notifications/auth_attempt.login'), $url);
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
            'message' => trans('notifications/auth_attempt.message')
        ];
    }
}
