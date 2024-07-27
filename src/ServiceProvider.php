<?php

namespace Baghunts\LaravelFastEndpoint;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Cache\Console\ClearCommand as IlluminateClearCommand;
use \Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

use Baghunts\LaravelFastEndpoint\Scanner\Scanner;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoint\Contracts\{EndpointConfigContract,
    ScannerContract,
    RouteGeneratorContract,
    RouterGeneratorContract,
};
use Baghunts\LaravelFastEndpoint\Generator\{RouteGenerator, RouterGenerator};
use Baghunts\LaravelFastEndpoint\Commands\{CacheCommand, ClearCommand, MakeEndpointCommand};

class ServiceProvider extends IlluminateServiceProvider
{
    const string FAST_ENDPOINTS_VERSION = '1.0.0';

    public function boot(): void
    {
        $this->binding();

        $this->bootConfigs();
        $this->bootRouters();
        $this->bootCommands();
    }

    private function binding(): void
    {
        $this->app->bind(EndpointConfigContract::class, EndpointConfig::class);
        $this->app->bind(RouteGeneratorContract::class, RouteGenerator::class);
        $this->app->bind(RouterGeneratorContract::class, RouterGenerator::class);
        $this->app->bind(ScannerContract::class,  function () {
            return $this->app->make(Scanner::class, [
                "dir" => config('fast-endpoints.dist'),
                "signature" => Endpoint::class
            ]);
        });
    }

    private function bootConfigs(): void
    {
        $this->publishes([
            __DIR__ . "/config/fast-endpoints.php" => config_path('fast-endpoints.php'),
        ]);
        $this->mergeConfigFrom(__DIR__ . '/config/fast-endpoints.php', 'fast-endpoints');
    }

    private function bootRouters(): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        [$tmpPath, $file] = app(RouterGeneratorContract::class)->getRoutesGeneratedFileMeta();

        $this->loadRoutesFrom($tmpPath);
        fclose($file);
    }

    private function bootCommands(): void
    {
        AboutCommand::add("Laravel Fast Endpoints Command", fn() => [
            "version" => self::FAST_ENDPOINTS_VERSION,
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                CacheCommand::class,
                ClearCommand::class,
                MakeEndpointCommand::class,
            ]);

            $this->app->extend(IlluminateClearCommand::class, function (IlluminateClearCommand $clearCommand) {
                Artisan::call('fast-endpoint:cache:clear');
                return $clearCommand;
            });
        }
    }

}