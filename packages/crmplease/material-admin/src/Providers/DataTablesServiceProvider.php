<?php

namespace Crmplease\MaterialAdmin\Providers;

use Crmplease\MaterialAdmin\DataTables\DataTables;
use Crmplease\MaterialAdmin\DataTables\Html\Builder;
use Crmplease\MaterialAdmin\DataTables\Utilities\Request;
use Illuminate\Support\ServiceProvider;

class DataTablesServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->alias('datatables', DataTables::class);
		$this->app->singleton('datatables', function () {
			return new DataTables;
		});

		$this->app->singleton('datatables.request', function () {
			return new Request;
		});

		$this->app->bind('datatables.html', function () {
			return $this->app->make(Builder::class);
		});
	}
}
