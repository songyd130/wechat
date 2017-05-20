<?php

namespace App\Providers;

use Illuminate\Routing\Router;
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
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $this->mapWebRoutes($router);
        //后台路由
        $this->mapBackendRoutes($router);
        //API路由
        $this->mapApiRoutes($router);
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace,
            'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/Routes/web.php');
        });
    }

    /**
     * @author  Song Yingdong <songyingdong@kmf.com>
     * @param Router $router
     */
    protected function mapBackendRoutes(Router $router)
    {
        $router->group([
            'namespace' => sprintf('%s\%s', $this->namespace, 'Backend'),
            'middleware' => ['web', 'backend'],
            'prefix'     => 'backend',
        ], function ($router) {
            require app_path('Http/Routes/backend.php');
        });
    }

    /**
     * @author  Song Yingdong <songyingdong@kmf.com>
     * @param Router $router
     */
    protected function mapApiRoutes(Router $router)
    {
        $router->group([
            'namespace' => sprintf('%s\%s', $this->namespace, 'Api'),
            'middleware' => 'api',
            'prefix'     => 'api',
        ], function ($router) {
            require app_path('Http/Routes/api.php');
        });
    }
}
