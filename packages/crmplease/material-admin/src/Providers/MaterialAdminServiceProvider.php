<?php

namespace Crmplease\MaterialAdmin\Providers;

use Crmplease\MaterialAdmin\Sidebar\Sidebar;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class MaterialAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootDatabaseMigrations();
        $this->bootFormConsiderRequrest();
        $this->bootConfigs();
        $this->bootPublic();
        $this->bootRelationMorphMap();
        $this->bootRepositories();
        $this->bootRouteMacro();
        $this->bootScheme();
        $this->bootTranslations();
        $this->bootViews();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerDataTables();
        $this->registerSidebar();
    }

    /**
     * Fix database migration error
     *
     * @see: https://laravel-news.com/laravel-5-4-key-too-long-error
     */
    protected function bootDatabaseMigrations()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Fix consider request config.
     *
     * @see https://github.com/LaravelCollective/html/issues/531
     */
    protected function bootFormConsiderRequrest()
    {
        app('form')->considerRequest(true);
    }

    /**
     * Publish configs
     */
    public function bootConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/app.php', 'app');
        $this->mergeConfigFrom(__DIR__ . '/../../config/colors.php', 'colors');
        $this->mergeConfigFrom(__DIR__ . '/../../config/files.php', 'files');
        $this->mergeConfigFrom(__DIR__ . '/../../config/images.php', 'images');
        $this->mergeConfigFrom(__DIR__ . '/../../config/locales.php', 'locales');
        $this->mergeConfigFrom(__DIR__ . '/../../config/namespaces.php', 'namespaces');
        $this->mergeConfigFrom(__DIR__ . '/../../config/resources.php', 'resources');
        $this->mergeConfigFrom(__DIR__ . '/../../config/repositories.php', 'repositories');
        $this->mergeConfigFrom(__DIR__ . '/../../config/snappy.php', 'snappy');

        $this->publishes([
            __DIR__ . '/../../config/datatables.php' => config_path('datatables.php'),
            __DIR__ . '/../../config/datatables-html.php' => config_path('datatables-html.php'),
            __DIR__ . '/../../config/datatables-i18n.php' => config_path('datatables-i18n.php'),
            __DIR__ . '/../../config/files.php' => config_path('files.php'),
            __DIR__ . '/../../config/images.php' => config_path('images.php'),
            __DIR__ . '/../../config/locales.php' => config_path('locales.php'),
            __DIR__ . '/../../config/namespaces.php' => config_path('namespaces.php'),
            __DIR__ . '/../../config/resources.php' => config_path('resources.php'),
            __DIR__ . '/../../config/repositories.php' => config_path('repositories.php'),
            __DIR__ . '/../../config/snappy.php' => config_path('snappy.php'),
        ], 'config');

    }

    /**
     * Publish assets
     */
    public function bootPublic()
    {
        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/material-admin'),
        ], 'public');
    }

    /**
     * Setup Relation morph map
     */
    protected function bootRelationMorphMap()
    {
        Relation::morphMap(config('resources', []));
    }

    /**
     * Bind repositories
     */
    protected function bootRepositories()
    {
        $repositories = config('repositories', []);

        foreach ($repositories as $interface => $implementation) {
            if (class_exists($implementation)) {
                app()->bind($interface, $implementation);
            }
        }
    }

    /**
     * Route macro
     */
    public function bootRouteMacro()
    {
        Route::macro('material', function ($resource, $controller, $options) {

            $namespace = $options['as'];

            if (has_controller($resource, $controller, $namespace)) {

                Route::put("{$resource}/{{$resource}}/restore", "${controller}@restore")->name("{$namespace}.{$resource}.restore");
                Route::get("{$resource}/trashed", "${controller}@trashed")->name("{$namespace}.{$resource}.trashed");
                Route::resource($resource, $controller, $options);

            }

        });
    }

    /**
     * Setup URL schema
     */
    protected function bootScheme()
    {
        app('url')->forceScheme(config('app.scheme', 'http'));
    }

    /**
     * Publish translations
     */
    public function bootTranslations()
    {
        $path = resource_path('lang');

        if (is_dir($path)) {
            $this->loadTranslationsFrom($path, 'material-admin');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'material-admin');
        }

        $this->publishes([
            __DIR__ . '/../../resources/lang' => resource_path('lang'),
        ], 'lang');
    }

    /**
     * Setup views path
     */
    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/datatables', 'datatables');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/laravel-form-builder', 'laravel-form-builder');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/material-admin', 'material-admin');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/notifications', 'notifications');

        $this->publishes([
            __DIR__ . '/../../resources/views/datatables' => base_path('resources/views/vendor/datatables'),
            __DIR__ . '/../../resources/views/laravel-form-builder' => base_path('resources/views/vendor/laravel-form-builder'),
            __DIR__ . '/../../resources/views/material-admin' => base_path('resources/views/vendor/material-admin'),
            __DIR__ . '/../../resources/views/notifications' => base_path('resources/views/vendor/notifications')
        ], 'views');
    }

    /**
     * Register DataTables custom service provider
     */
    protected function registerDataTables()
    {
        $this->app->register(DataTablesServiceProvider::class);
    }

    /**
     * Register DataTables custom service provider
     */
    protected function registerSidebar()
    {
        $this->app->singleton(Sidebar::class, function () {
            return new Sidebar();
        });

        $this->app->alias(Sidebar::class, 'sidebar');
    }
}
