<?php

namespace App\Providers;

use Go\Core\AspectContainer;
use App\Aspect\LoggingAspect;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AopServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var AspectContainer $aspectContainer */
        $aspectContainer = $this->app->make(AspectContainer::class);

        // Let's collect all aspects and just register them in the container
        $aspects = $this->app->tagged('goaop.aspect');
        foreach ($aspects as $aspect) {
            $aspectContainer->registerAspect($aspect);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LoggingAspect::class, function (Application $app) {
            return new LoggingAspect($app->make(LoggerInterface::class));
        });

        $this->app->tag([LoggingAspect::class], 'goaop.aspect');
    }
}
