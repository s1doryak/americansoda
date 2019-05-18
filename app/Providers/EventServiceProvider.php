<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
		\Crmplease\MaterialAdmin\Events\ResourceRequested::class => [

		],

		\Crmplease\MaterialAdmin\Events\ResourceStored::class => [

		],

		\Crmplease\MaterialAdmin\Events\ResourceUpdated::class => [

		],

		\Crmplease\MaterialAdmin\Events\ResourceDestroyed::class => [

		],

		\Crmplease\MaterialAdmin\Events\ResourceTrashed::class => [

		],

		\Crmplease\MaterialAdmin\Events\ResourceRestored::class => [

		],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
