<?php

namespace App\Illuminate\Notifications;

use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Notifications\RoutesNotifications;

trait Notifiable
{
    use HasDatabaseNotifications, RoutesNotifications;

    /**
     * @return string|null
     */
    public function preferredLocale()
    {
        return config('app.notification_locale');
    }
}
