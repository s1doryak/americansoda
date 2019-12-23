<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		\App\Console\Commands\Resources\RegionCreator::class,
		\App\Console\Commands\Resources\CompanyCreator::class,
		\App\Console\Commands\Resources\RoleCreator::class,
		\App\Console\Commands\Resources\UserCreator::class,
		\App\Console\Commands\Resources\AdministratorCreator::class,
		\App\Console\Commands\Resources\BrandCreator::class,
		\App\Console\Commands\Resources\PackageTypeCreator::class,
		\App\Console\Commands\Resources\ProductGroupCreator::class,
		\App\Console\Commands\Resources\ProductCreator::class,
		\App\Console\Commands\Resources\StockCreator::class,
		\App\Console\Commands\Resources\PaymentTypeCreator::class,
		\App\Console\Commands\Resources\CustomerTypeCreator::class,
		\App\Console\Commands\Resources\CustomerCreator::class,
		\App\Console\Commands\Resources\CustomerRevisionCreator::class,
		\App\Console\Commands\Resources\CustomerOrderCreator::class,
		\App\Console\Commands\Resources\CustomerShipmentCreator::class,
		\App\Console\Commands\Resources\CustomerOrderItemCreator::class,
		\App\Console\Commands\Resources\CustomerPricingPolicyCreator::class,
		\App\Console\Commands\Resources\CustomerPricingPolicyRevisionCreator::class,
		\App\Console\Commands\Resources\AssemblyCreator::class,
		\App\Console\Commands\Resources\StockMovementCreator::class,
		\App\Console\Commands\Resources\StockMovementProductCreator::class,
		\App\Console\Commands\Resources\StockProductCreator::class,
		\App\Console\Commands\Resources\ProductTagCreator::class,
		\App\Console\Commands\Resources\CompanyBankAccountCreator::class,
		\App\Console\Commands\Resources\CustomerInvoiceCreator::class,
		\App\Console\Commands\Resources\CustomerInvoiceActionCreator::class,
		\App\Console\Commands\Resources\CustomerInvoiceAttachmentCreator::class,
		\App\Console\Commands\Resources\CustomerInvoiceItemCreator::class,
		\App\Console\Commands\Resources\PriceGroupCreator::class,
		\App\Console\Commands\Resources\PriceGroupBreakpointCreator::class,
		\App\Console\Commands\Resources\CustomerUserCreator::class,
		\App\Console\Commands\Resources\CustomerUserTokenCreator::class,
		\App\Console\Commands\Resources\CustomerPreOrderCreator::class,
		\App\Console\Commands\Resources\CustomerPreOrderItemCreator::class,

        \App\Console\Commands\Maventa\MaventaImportInvoice::class,
        \App\Console\Commands\Maventa\MaventaImportInvoices::class,
        \App\Console\Commands\Resources\BannerCreator::class,
        \App\Console\Commands\Resources\ProductTypeCreator::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param \Illuminate\Console\Scheduling\Schedule $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		// $schedule->command('inspire')
		//          ->hourly();
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		$this->load(__DIR__ . '/Commands');

		require base_path('routes/console.php');
	}
}
