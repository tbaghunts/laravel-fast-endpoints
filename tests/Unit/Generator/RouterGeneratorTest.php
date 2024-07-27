<?php

namespace Tests\Unit\Generator;

use Illuminate\Support\Str;
use \Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\{Config};
use Illuminate\Foundation\Testing\RefreshDatabase;

use Orchestra\Testbench\TestCase;
use Orchestra\Testbench\Concerns\WithWorkbench;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;

use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoint\Generator\RouterGenerator;
use Psr\SimpleCache\InvalidArgumentException;
use Baghunts\LaravelFastEndpoint\Contracts\{
    ScannerContract,
    RouteGeneratorContract,
    RouterGeneratorContract
};

class RouterGeneratorTest extends TestCase
{
    use WithWorkbench, RefreshDatabase;

    private ?MockObject $scannerStub = null;
    private ?MockObject $routeGeneratorStub = null;

    private string $randomEndpointsPrefixKey = "shikagi";

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->randomEndpointsPrefixKey = Str::random(6);

        $this->scannerStub = $this->createMock(ScannerContract::class);
        $this->routeGeneratorStub = $this->createMock(RouteGeneratorContract::class);

        $this->afterApplicationCreated(function () {
            Config::set("fast-endpoints.prefix", $this->randomEndpointsPrefixKey);

            $this->app->bind(ScannerContract::class, fn() => $this->scannerStub);
            $this->app->bind(RouterGeneratorContract::class, RouterGenerator::class);
            $this->app->bind(RouteGeneratorContract::class, fn() => $this->routeGeneratorStub);
        });

        parent::setUp();
    }

    public function getInstance(): RouterGeneratorContract
    {
        return app(RouterGenerator::class);
    }

    public function test_getRoutesSourceWithoutEndpoints()
    {
        $instance = $this->getInstance();
        $this->scannerStub->method('findEndpoints')->willReturn(collect());

        $this->assertEquals(
            sprintf(<<<PHP
            <?php
            use Illuminate\Support\Facades\Route;
            
            Route::prefix('%s')->group(function() {
            
            });
            PHP, $this->randomEndpointsPrefixKey),
            $instance->getRoutesSource()
        );
    }

    public function test_getRoutesSourceWithEndpoints()
    {
        $instance = $this->getInstance();
        $this->scannerStub->method('findEndpoints')->willReturn(collect([
            new EndpointConfig(),
            new EndpointConfig(),
            new EndpointConfig(),
        ]));
        $this->routeGeneratorStub->method('output')->willReturn("route-generator-output");

        $this->assertEquals(
            sprintf(<<<PHP
            <?php
            use Illuminate\Support\Facades\Route;
            
            Route::prefix('%s')->group(function() {
            route-generator-output
            route-generator-output
            route-generator-output
            });
            PHP, $this->randomEndpointsPrefixKey),
            $instance->getRoutesSource()
        );
    }

    /**
     */
    public function test_getRoutesSourceWithCachedData()
    {
        $instance = $this->getInstance();
        $this->scannerStub->method('findEndpoints')->willReturn(collect());

        Cache::set(config("fast-endpoints.cache_key"), "Shikagi");

        $this->assertEquals(
            "Shikagi",
            $instance->getRoutesSource()
        );
    }

    public function test_getRoutesGeneratedFileMeta()
    {
        $instance = $this->getInstance();
        $meta = $instance->getRoutesGeneratedFileMeta();

        $this->assertIsArray($meta);
        $this->assertCount(2, $meta);

        $this->assertTrue(is_string($meta[0]));
        $this->assertTrue(is_resource($meta[1]));
    }

}