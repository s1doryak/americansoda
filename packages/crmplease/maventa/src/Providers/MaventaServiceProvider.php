<?php

namespace Crmplease\Maventa\Providers;

use Crmplease\Maventa\Maventa;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class MaventaServiceProvider extends ServiceProvider implements DeferrableProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->bootConfigs();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(Maventa::class, function ($app) {

			$connection = $app['config']['maventa']['default'];

			$config = $app['config']['maventa']['connections'][$connection];

			return new Maventa($config['user_api_key'], $config['company_uuid'], $config['vendor_api_key'], $config['base_url'], (array)$config['options']);
		});

		$this->app->alias(Maventa::class, 'maventa');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [Maventa::class];
	}

	/**
	 * Publish configs
	 */
	public function bootConfigs()
	{
		$this->mergeConfigFrom(__DIR__ . '/../../config/maventa.php', 'maventa');

		$this->publishes([
			__DIR__ . '/../../config/maventa.php' => config_path('maventa.php'),
		], 'config');

	}


}