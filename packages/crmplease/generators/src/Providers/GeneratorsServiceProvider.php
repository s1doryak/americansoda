<?php

namespace Crmplease\Generators\Providers;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{
	/**
	 * @var array Command List
	 */
	protected $commands = [
		\Crmplease\Generators\Console\Commands\Generators\GenerateModel::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateForm::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateTransformer::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateDataTable::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateRepository::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateRepositoryEloquent::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateController::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateMigration::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateMigrationPivot::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateMigrationPasswordResets::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateFactory::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateSeeder::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateTranslation::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateListener::class,
        \Crmplease\Generators\Console\Commands\Generators\GenerateNotification::class,
		\Crmplease\Generators\Console\Commands\Generators\GeneratePolicy::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateResource::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateCreator::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateNamespace::class,
		\Crmplease\Generators\Console\Commands\Generators\GenerateLocale::class,
		\Crmplease\Generators\Console\Commands\Generators\ModifyResource::class
	];

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->bootConfigs();
		$this->bootTranslations();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCommands();
	}

	/**
	 * Publish configs
	 */
	public function bootConfigs()
	{
		$this->mergeConfigFrom(__DIR__ . '/../../config/generators.php', 'generators');

		$this->publishes([
			__DIR__ . '/../../config/generators.php' => config_path('generators.php'),
		], 'config');

	}

	/**
	 * Publish translations
	 */
	public function bootTranslations()
	{
		$path = resource_path('lang');

		if (is_dir($path)) {
			$this->loadTranslationsFrom($path, 'generators');
		} else {
			$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'generators');
		}

		$this->publishes([
			__DIR__ . '/../../resources/lang' => resource_path('lang'),
		], 'lang');
	}

	/**
	 * Register Commands
	 */
	protected function registerCommands()
	{
		foreach ($this->commands as $command) {
			$this->app->singleton($command, function ($app) use ($command) {
				return new $command($app['files'], $app['composer']);
			});
		}

		$this->commands($this->commands);
	}
}
