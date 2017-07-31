<?php

namespace Baytek\Laravel\Users\Members;

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
    // protected $namespace = Baytek\Laravel\Content\Types\member::class;

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
        if(config('member.routes.enabled')) {
            $this->mapAdminRoutes();
            $this->mapApiRoutes();
            $this->mapWebRoutes();
        }
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        $routes = 'routes/admin/member.php';
        if(file_exists(base_path($routes))){
            Route::prefix('admin') //Just use the admin prefix, so we can properly define the resource routes
                 ->middleware(['web', 'auth'])
                 ->namespace(Controllers::class)
                 ->group(base_path($routes));
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $routes = 'routes/api/member.php';
        if(file_exists(base_path($routes))){
            Route::prefix('api/members')
                 ->middleware(['api', 'auth'])
                 ->namespace(Controllers\Api::class)
                 ->group(base_path($routes));
        }
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
        $routes = 'routes/web/member.php';
        if(file_exists(base_path($routes))){
            Route::middleware('web')
                 ->namespace(Controllers::class)
                 ->group(base_path($routes));
        }
    }
}
