<?php

namespace App\Providers;

use App\Repositories\Contracts\AdministratorRepository;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobFailed;

class AppServiceProvider extends ServiceProvider
{
    public function bootQueueEvents()
    {
        Queue::failing(function (JobFailed $event) {
            Notification::sendNow(
                app(AdministratorRepository::class)->notifiable(),
                new \App\Notifications\Cli\JobFailed(class_basename($event->job->resolveName()), $event->exception)
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootQueueEvents();
        $this->loadViewsFrom(resource_path('views/app'), 'app');
        $this->loadViewsFrom(resource_path('views/dashboard'), 'dashboard');
        // ...views
    }
}
