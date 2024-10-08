<?php

namespace Baghunts\LaravelFastEndpoints;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

use Baghunts\LaravelFastEndpoints\Scanner\Scanner;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoints\Contracts\{
    ScannerContract,
    EndpointConfigContract,
    RouteGeneratorContract,
    ClassGeneratorContract,
    RouterGeneratorContract,
};
use Baghunts\LaravelFastEndpoints\Commands\MakeEndpointCommand;
use Baghunts\LaravelFastEndpoints\Generator\{
    RouteGenerator,
    ClassGenerator,
    RouterGenerator,
};

class ServiceProvider extends IlluminateServiceProvider
{
    const string FAST_ENDPOINTS_VERSION = '1.0.0';

    public function boot(): void
    {
        $this->binding();

        $this->bootConfigs();
        $this->bootRouters();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/./config/fast-endpoints.php', 'fast-endpoints');

        $this->registerCommands();
    }

    private function binding(): void
    {
        $this->app->bind(EndpointConfigContract::class, EndpointConfig::class);
        $this->app->bind(RouteGeneratorContract::class, RouteGenerator::class);
        $this->app->bind(RouterGeneratorContract::class, RouterGenerator::class);
        $this->app->bind(ClassGeneratorContract::class, ClassGenerator::class);
        $this->app->bind(ScannerContract::class,  function () {
            return $this->app->make(Scanner::class, [
                'signature' => Endpoint::class,
                'dir' => config('fast-endpoints.dist'),
            ]);
        });
    }

    private function bootConfigs(): void
    {
        $this->publishes([
            __DIR__ . '/./config/fast-endpoints.php' => config_path('fast-endpoints.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/./stubs' => base_path('stubs/fast-endpoints'),
        ], 'stubs');
    }

    private function bootRouters(): void
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        app(RouterGeneratorContract::class)->generate();
    }

    private function registerCommands(): void
    {
        AboutCommand::add('Laravel Fast Endpoints Command', fn() => [
            'version' => self::FAST_ENDPOINTS_VERSION,
        ]);

        $this->commands([
            MakeEndpointCommand::class,
        ]);
    }

}