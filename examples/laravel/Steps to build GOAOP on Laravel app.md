# Laravel AOP Step by Step

## Steps to build GOAOP on Laravel app:

1. Import dependencies through composer:

   ```sh
   composer require goaop/framework
   composer require goaop/goaop-laravel-bridge
   ```

2. Add the provider:

   ```php
   // config/app.php
   ...
   'providers' => [
       // Go! Aspect Service Provider
       Go\Laravel\GoAopBridge\GoAopServiceProvider::class,
       ...
   ];
   ...
   ```

3. Publish config file:

   ```Shell
   ./artisan vendor:publish --provider="Go\Laravel\GoAopBridge\GoAopServiceProvider"
   ```

4. Create your first Aspect:

   ```php
   <?php

   namespace App\Aspect;

   use Go\Aop\Aspect;
   use Go\Aop\Intercept\MethodInvocation;
   use Go\Lang\Annotation\Before;
   use Psr\Log\LoggerInterface;

   /**
    * Application logging aspect
    */
   class LoggingAspect implements Aspect
   {
       /**
        * @var LoggerInterface
        */
       private $logger;

       public function __construct(LoggerInterface $logger)
       {
           $this->logger = $logger;
       }

       /**
        * Writes a log info before method execution
        *
        * @param MethodInvocation $invocation
        * @Before("execution(public **->*(*))")
        */
       public function beforeMethod(MethodInvocation $invocation)
       {
           $this->logger->info($invocation, $invocation->getArguments());
       }
   }
   ```

5. Create your Service Provider to register your aspects in the container:

   ```shell
   ./artisan make:provider AopServiceProvider
   ```

6. After register your Aspect, your service provider would looke like this:

   ```php

   namespace App\Providers;

   use App\Aspect\LoggingAspect;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Support\ServiceProvider;
   use Psr\Log\LoggerInterface;

   class AopServiceProvider extends ServiceProvider
   {

       /**
        * Register the application services.
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
   ```

   ## Pointcut Reference

   http://go.aopphp.com/docs/pointcut-reference/

