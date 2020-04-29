<?php

namespace Crmplease\Generators\Console\Commands\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

trait NotificationAttributes
{
    /**
     * @return Collection
     */
    protected function getNotificationChannels()
    {
        if ($this->option('channel')) {
            return collect(
                (array)$this->option('channel')
            );
        }

        return collect([
            self::NOTIFICATION_CHANNEL
        ]);
    }

    /**
     * @param Collection $channels
     * @return string
     */
    protected function dumpNotificationChannels($channels)
    {
        return $channels->map(function ($channel) {
            return sprintf("'%s'", $channel);
        })->join(",");
    }

    /**
     * @return string
     */
    protected function getNotificationSubject()
    {
        if ($this->option('subject')) {
            return (string)$this->option('subject');
        }

        return $this->getNameInput();
    }

    /**
     * @param string $notification
     * @return string
     */
    protected function dumpNotificationSubject($notification)
    {
        return sprintf("trans('notifications/%s.subject')", Str::snake($notification));
    }

    /**
     * @return string
     */
    protected function getNotificationMessage()
    {
        if ($this->option('message')) {
            return (string)$this->option('message');
        }

        return $this->getNameInput();
    }

    /**
     * @param string $notification
     * @return string
     */
    protected function dumpNotificationMessage($notification)
    {
        return sprintf("trans('notifications/%s.message')", Str::snake($notification));
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getNotificationOptions()
    {
        return [
            // ['parameter', 'p', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Notification parameter.'],

            ['channel', 'c', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Notification channel.'],

            ['subject', 's', InputOption::VALUE_OPTIONAL, 'Notification subject.'],

            ['message', 'm', InputOption::VALUE_OPTIONAL, 'Notification message.'],
        ];
    }
}
