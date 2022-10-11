<?php

namespace Modules\Support;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use ReflectionClass;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapFrontRoutes();

        $this->mapWebRoutes();

        $this->mapSiteRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapFrontRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            $routesPath = $this->getCurrentDir().'/routes/front.php';

            if (file_exists($routesPath)) {
                require $routesPath;
            }
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => ['web', 'auth.user'],
            'namespace' => $this->namespace,
        ], function ($router) {
            $routesPath = $this->getCurrentDir().'/routes/app.php';

            if (file_exists($routesPath)) {
                require $routesPath;
            }
        });
    }

    protected function mapSiteRoutes()
    {
        Route::group([
            'middleware' => 'auth:sanctum',
            'namespace' => $this->namespace,
            'prefix' => 'site',
        ], function ($router) {
            $routesPath = $this->getCurrentDir().'/routes/site.php';

            if (file_exists($routesPath)) {
                require $routesPath;
            }
        });
    }

    /**
     * Returns the module directory in context.
     */
    protected function getCurrentDir(): string
    {
        $classInfo = new ReflectionClass($this);

        return dirname($classInfo->getFileName());
    }
}
