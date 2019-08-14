<?php

namespace App\Notifications\Cli;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * JobFailed notification.
 *
 * @package App\Notifications\Cli
 */
class JobFailed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    public $job;

    /**
     * @var \Exception
     */
    public $exception;

    /**
     * JobFailed constructor.
     * @return void
     */
    public function __construct($job, \Exception $exception)
    {
        $this->job = $job;
        $this->exception = $exception;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('notifications/job_failed.subject'))
            ->line(trans('notifications/job_failed.message', [
                'job' => $this->job
            ]))
            ->action(trans('notifications/job_failed.action'), route('dashboard.failed_job.index'))
            ->line(trans('notifications/job_failed.exception.message', [
                'message' => $this->exception->getMessage()
            ]))
            ->line(trans('notifications/job_failed.exception.file', [
                'file' => $this->exception->getFile()
            ]))
            ->line(trans('notifications/job_failed.exception.line', [
                'line' => $this->exception->getLine()
            ]))
            ->line(trans('notifications/job_failed.exception.trace', [
                'trace' => $this->exception->getTraceAsString()
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
            'message' => trans('notifications/job_failed.message')
        ];
    }
}
