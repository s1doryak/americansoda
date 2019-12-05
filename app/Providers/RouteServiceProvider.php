<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapAppRoutes();
        $this->mapDashboardRoutes();
        $this->mapApiV1Routes();
		// ...$this->mapRoutes()
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "app" routes for the application.
     *
     * @return void
     */
    protected function mapAppRoutes()
    {
        Route::middleware('app')
            ->namespace(config('namespaces.app'))
            ->group(base_path('routes/app.php'));
    }

    /**
     * Define the "dashboard" routes for the application.
     *
     * @return void
     */
    protected function mapDashboardRoutes()
    {
        Route::middleware('dashboard')
            ->namespace(config('namespaces.dashboard'))
            ->group(base_path('routes/dashboard.php'));
    }


    /**
	 * Define the "api/v1" routes for the application.
	 *
	 * @return void
	 */
	protected function mapApiV1Routes()
	{
		Route::middleware('api/v1')
			->namespace(config('namespaces.api/v1'))
			->group(base_path('routes/api/v1.php'));
	}
	
	// ...mapRoutes()

}
