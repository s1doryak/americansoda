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

            /**
             * Исправляем номер клиента
             */
            \App\Listeners\Dashboard\FixCustomerNumber::class,

            /**
             * Исправляем номер заказа
             */
            \App\Listeners\Dashboard\FixCustomerOrderNumber::class,

            /**
             * Устанавливаем атрибуты счёта
             */
            \App\Listeners\Dashboard\SetupCustomerInvoiceAttributes::class,

            /**
             * Создает позициии счёта клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,

            /**
             * Создает ценовые политики (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerPricingPolicies::class,

            /**
             * Создает позициии заказа клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerOrderItems::class,

            /**
             * Создает позициии товара на складе (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignStockMovementProducts::class,

            /**
             * Создает градации цен по каждой товарной группе (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignPriceGroupBreakpoints::class,

            /**
             * Создает ревизию информации о клиенте
             */
            \App\Listeners\Dashboard\CreateCustomerRevision::class,

            /**
             * Создает ревизию ценовых политик клиента
             */
            \App\Listeners\Dashboard\CreateCustomerPricingPolicyRevision::class,

            /**
             * Генерирует JWT токен для созданного юзера
             */
            // \App\Listeners\Api\GenerateUserAuthToken::class,
        ],

        \Crmplease\MaterialAdmin\Events\ResourceUpdated::class => [

            /**
             * Устанавливаем атрибуты счёта
             */
            \App\Listeners\Dashboard\SetupCustomerInvoiceAttributes::class,

            /**
             * Создает позициии счёта клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,

            /**
             * Создает ценовые политики (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerPricingPolicies::class,

            /**
             * Создает позициии заказа клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerOrderItems::class,

            /**
             * Создает градации цен по каждой товарной группе (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignPriceGroupBreakpoints::class,

            /**
             * Удаляет позиции заказ из отгрузки (если была нажата кнопка Remove)
             */
            \App\Listeners\Dashboard\ManageShipmentsAndAssemblies::class,

            /**
             * Создает ревизию информации о клиенте
             */
            \App\Listeners\Dashboard\CreateCustomerRevision::class,

            /**
             * Создает ревизию ценовых политик клиента
             */
            \App\Listeners\Dashboard\CreateCustomerPricingPolicyRevision::class,
        ],

        \Crmplease\MaterialAdmin\Events\ResourceDestroyed::class => [

            /**
             * Создает позициии счёта клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,

            /**
             * Создает позициии заказа клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerOrderItems::class,

            /**
             * Создает градации цен по каждой товарной группе (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignPriceGroupBreakpoints::class,

            /**
             * При удалении отгрузки очищать номера сборки у позиций заказа
             */
            \App\Listeners\Dashboard\ManageShipmentsAndAssemblies::class,

            /**
             * Создает ревизию информации о клиенте
             */
            \App\Listeners\Dashboard\CreateCustomerRevision::class,

            /**
             * Создает ревизию ценовых политик клиента
             */
            \App\Listeners\Dashboard\CreateCustomerPricingPolicyRevision::class,
        ],

        \Crmplease\MaterialAdmin\Events\ResourceTrashed::class => [

            /**
             * Создает позициии счёта клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,

            /**
             * Создает позициии заказа клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerOrderItems::class,

            /**
             * Создает градации цен по каждой товарной группе (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignPriceGroupBreakpoints::class,

            /**
             * При удалении отгрузки очищать номера сборки у позиций заказа
             */
            \App\Listeners\Dashboard\ManageShipmentsAndAssemblies::class,

            /**
             * Создает ревизию информации о клиенте
             */
            \App\Listeners\Dashboard\CreateCustomerRevision::class,

            /**
             * Создает ревизию ценовых политик клиента
             */
            \App\Listeners\Dashboard\CreateCustomerPricingPolicyRevision::class,

        ],

        \Crmplease\MaterialAdmin\Events\ResourceRestored::class => [

            /**
             * Создает позициии счёта клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerInvoiceItems::class,

            /**
             * Создает позициии заказа клиента (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignCustomerOrderItems::class,

            /**
             * Создает градации цен по каждой товарной группе (делает синхронизацию 1-М сущностей)
             */
            \App\Listeners\Dashboard\AssignPriceGroupBreakpoints::class,

            /**
             * Создает ревизию информации о клиенте
             */
            \App\Listeners\Dashboard\CreateCustomerRevision::class,

            /**
             * Создает ревизию ценовых политик клиента
             */
            \App\Listeners\Dashboard\CreateCustomerPricingPolicyRevision::class,

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
