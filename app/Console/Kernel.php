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
		\App\Console\Commands\RegionCreator::class,
		\App\Console\Commands\CompanyCreator::class,
		\App\Console\Commands\RoleCreator::class,
		\App\Console\Commands\UserCreator::class,
		\App\Console\Commands\AdministratorCreator::class,
		\App\Console\Commands\BrandCreator::class,
		\App\Console\Commands\PackageTypeCreator::class,
		\App\Console\Commands\ProductGroupCreator::class,
		\App\Console\Commands\ProductCreator::class,
		\App\Console\Commands\StockCreator::class,
		\App\Console\Commands\PaymentTypeCreator::class,
		\App\Console\Commands\CustomerTypeCreator::class,
		\App\Console\Commands\CustomerCreator::class,
		\App\Console\Commands\CustomerRevisionCreator::class,
		\App\Console\Commands\CustomerOrderCreator::class,
		\App\Console\Commands\CustomerShipmentCreator::class,
		\App\Console\Commands\CustomerOrderItemCreator::class,
		\App\Console\Commands\CustomerPricingPolicyCreator::class,
		\App\Console\Commands\CustomerPricingPolicyRevisionCreator::class,
		\App\Console\Commands\AssemblyCreator::class,
		\App\Console\Commands\StockMovementCreator::class,
		\App\Console\Commands\StockMovementProductCreator::class,
		\App\Console\Commands\StockProductCreator::class,
		\App\Console\Commands\ProductTagCreator::class,
		\App\Console\Commands\CompanyBankAccountCreator::class,
		\App\Console\Commands\CustomerInvoiceCreator::class,
		\App\Console\Commands\CustomerInvoiceActionCreator::class,
		\App\Console\Commands\CustomerInvoiceAttachmentCreator::class,
		\App\Console\Commands\CustomerInvoiceItemCreator::class,
		\App\Console\Commands\PriceGroupCreator::class,
		\App\Console\Commands\PriceGroupBreakpointCreator::class,
		\App\Console\Commands\CustomerUserCreator::class,
		\App\Console\Commands\CustomerUserTokenCreator::class,
		\App\Console\Commands\CustomerPreOrderCreator::class,
		\App\Console\Commands\CustomerPreOrderItemCreator::class,






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
