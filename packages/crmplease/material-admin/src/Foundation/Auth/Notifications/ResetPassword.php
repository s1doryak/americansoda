<?php

namespace Crmplease\MaterialAdmin\Foundation\Auth\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends \Illuminate\Auth\Notifications\ResetPassword
{
    /**
     * @param mixed $notifiable
     *
     * @return string
     */
    public function getPrefix($notifiable)
    {
        $namespaces = collect(config('auth.guards'))->filter(
            function ($guard) use ($notifiable) {
                return $guard['provider'] == $notifiable->getTable();
            }
        )->keys();

        return (string)$namespaces->first();
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $route = route(sprintf('%s.password.reset', $this->getPrefix($notifiable)), $this->token);

        return (new MailMessage)
            ->subject(trans('notifications/password_reset.subject'))
            ->line(trans('notifications/password_reset.line'))
            ->action(trans('notifications/password_reset.action'), url($route))
            ->salutation(trans('notifications/password_reset.salutation'));
    }
}
