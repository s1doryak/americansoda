<?php

namespace App\Providers;

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
            \App\Listeners\Dashboard\SetupCustomerInvoiceAttributes::class,
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,
        ],

        \Crmplease\MaterialAdmin\Events\ResourceUpdated::class => [
            \App\Listeners\Dashboard\SetupCustomerInvoiceAttributes::class,
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,
        ],

        \Crmplease\MaterialAdmin\Events\ResourceDestroyed::class => [
            \App\Listeners\Dashboard\SetupCustomerInvoiceAttributes::class,
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,
        ],

        \Crmplease\MaterialAdmin\Events\ResourceTrashed::class => [
            \App\Listeners\Dashboard\SetupCustomerInvoiceAttributes::class,
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,
        ],

        \Crmplease\MaterialAdmin\Events\ResourceRestored::class => [
            \App\Listeners\Dashboard\SetupCustomerInvoiceAttributes::class,
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,
        ],

        /**
         * События, выполняемые при создании позиций счёта клиента
         */
        \App\Events\Dashboard\CustomerInvoiceItemsAssigned::class => [

        ],

        /**
         * События, выполняемые при создании позиций заказа клиента
         */
        \App\Events\Dashboard\CustomerOrderItemsAssigned::class => [

            /**
             * Управляет резервами и бекордерами на складе
             */
            \App\Listeners\Dashboard\ManageStockProducts::class,
        ],

        /**
         * События, выполняемые при освобождении резерва (FreeStockProducts) и при (UpdateStockProducts)
         */
        \App\Events\Dashboard\StockProductsUpdated::class => [

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
