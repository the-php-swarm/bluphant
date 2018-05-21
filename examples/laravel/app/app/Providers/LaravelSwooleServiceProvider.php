<?php

namespace App\Providers;

use SwooleTW\Http\HttpServiceProvider;
use SwooleTW\Http\Server\Manager;

class LaravelSwooleServiceProvider extends HttpServiceProvider
{
    /**
     * Register manager.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('swoole.http', function ($app) {
            return new Manager($app, 'laravel');
        });
    }

    /**
     * Boot routes.
     *
     * @return void
     */
    protected function bootRoutes()
    {
        require __DIR__.'/../../routes/websocket.php';
    }
}
