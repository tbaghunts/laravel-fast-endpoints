<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase as TestbenchTestCase;

use Baghunts\LaravelFastEndpoint\ServiceProvider;
use Tests\Feature\Assets\Models\User;

abstract class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app): array
    {
        $app->make('config')->set(
            "fast-endpoints",
            array_merge(
                $this->getFastEndpointsConfig(),
                [
                    "prefix" => "test",
                    "dist" => __DIR__ . '/./Dist',
                ]
            )
        );

        return [
            ServiceProvider::class,
        ];
    }

    protected function getFastEndpointsConfig(): array
    {
        return [];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/./Assets/migrations');
    }
}