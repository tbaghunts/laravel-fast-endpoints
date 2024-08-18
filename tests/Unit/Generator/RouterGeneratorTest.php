<?php

namespace Tests\Unit\Generator;

use ReflectionException;

use Illuminate\Support\Str;
use Illuminate\Routing\Router;

use Orchestra\Testbench\TestCase;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;

use Baghunts\LaravelFastEndpoints\Generator\RouterGenerator;
use Baghunts\LaravelFastEndpoints\Contracts\{
    ScannerContract,
    RouteGeneratorContract,
    RouterGeneratorContract
};

class RouterGeneratorTest extends TestCase
{
    private ?MockObject $routerStub = null;
    private ?MockObject $scannerStub = null;
    private ?MockObject $routeGeneratorStub = null;

    private string $randomEndpointsPrefixKey = "shikagi";

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->randomEndpointsPrefixKey = Str::random(6);

        $this->routerStub = $this->createMock(Router::class);
        $this->scannerStub = $this->createMock(ScannerContract::class);
        $this->routeGeneratorStub = $this->createMock(RouteGeneratorContract::class);

        $this->afterApplicationCreated(function () {
            \config()->set("fast-endpoints", [
                "dist" => "dist.mock",
                "domain" => "{domain}.mock",
                "middleware" => ["mid1", "mid2"],
                "prefix" => $this->randomEndpointsPrefixKey,
            ]);

            $this->app->bind(ScannerContract::class, fn() => $this->scannerStub);
            $this->app->bind(RouteGeneratorContract::class, fn() => $this->routeGeneratorStub);
        });

        parent::setUp();
    }

    public function getInstance(): RouterGeneratorContract
    {
        return new RouterGenerator($this->routerStub, $this->scannerStub);
    }

    public function test_generateWithoutFoundEndpoints()
    {
        $this->scannerStub->expects($this->once())->method("findEndpoints")->willReturn([]);

        $this->routerStub->expects($this->never())->method("group");

        $this->getInstance()->generate();
    }

    public function test_generateWithFoundEndpoints()
    {
        $this->scannerStub->expects($this->once())->method("findEndpoints")->willReturn([
            "users-endpoint" => [],
            "pages-endpoint" => [],
        ]);

        $this->routerStub->expects($this->once())->method("group")->with(
            [
                "domain" => "{domain}.mock",
                "middleware" => ["mid1", "mid2"],
                "prefix" => $this->randomEndpointsPrefixKey,
            ],
            $this->anything()
        );

        $this->getInstance()->generate();
    }

    /**
     * @throws ReflectionException
     */
    public function test_generateRoutesShouldCallRouteGeneratorGenerate()
    {
        $instance = new \ReflectionClass($this->getInstance());
        $method = $instance->getMethod("generateRoutes");

        $this->routeGeneratorStub
            ->expects($this->exactly(2))
            ->method("generate");

        $method->invoke($this->getInstance(), [
            "users-endpoint" => [
                "path" => "users",
                "name" => "users.endpoint"
            ],
            "pages-endpoint" => [
                "path" => "pages",
                "name" => "pages.endpoint"
            ],
        ]);
    }
}