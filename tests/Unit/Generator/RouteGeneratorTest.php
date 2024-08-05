<?php

namespace Tests\Unit\Generator;

use ReflectionClass;
use ReflectionException;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockBuilder;

use Orchestra\Testbench\TestCase;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoint\Generator\RouteGenerator;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

class RouteGeneratorTest extends TestCase
{
    private ?Router $routerMock = null;
    private ?EndpointConfigContract $endpointConfigMock = null;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->routerMock = $this->createMock(Router::class);
        $this->endpointConfigMock = $this->createMock(EndpointConfigContract::class);
    }

    private function getInstance(): RouteGenerator
    {
        return new RouteGenerator(
            $this->routerMock,
            $classNamespace ?? "App\\Http\\Endpoints\\Users\\CreateUser",
            $this->endpointConfigMock
        );
    }

    private function getMock(): MockBuilder
    {
        return $this->getMockBuilder(RouteGenerator::class)
            ->setConstructorArgs([
                $this->routerMock,
                $classNamespace ?? "App\\Http\\Endpoints\\Users\\CreateUser",
                $this->endpointConfigMock
            ]);
    }

    private function getRoute(): Route
    {
        return new Route("GET", "/test", ["TestController@action"]);
    }

    public function test_routerShouldNotBeInitializedIfMethodsNotProvided()
    {
        $this->endpointConfigMock->expects($this->once())->method('getMethod')->willReturn([]);
        $this->endpointConfigMock->expects($this->once())->method('getPath')->willReturn("/users");

        $this->routerMock->expects($this->never())->method('addRoute');

        $this->assertNull($this->getInstance()->getRoute());
    }

    public function test_routerShouldNotBeInitializedIfPathNotProvided()
    {
        $this->endpointConfigMock->expects($this->once())->method('getMethod')->willReturn([EnumEndpointMethod::POST]);
        $this->endpointConfigMock->expects($this->once())->method('getPath')->willReturn("");

        $this->routerMock->expects($this->never())->method('addRoute');

        $this->assertNull($this->getInstance()->getRoute());
    }

    public function test_routeShouldBeInitializedIfMethodsAndPathIsProvided()
    {
        $this->endpointConfigMock->method('getMethod')->willReturn([EnumEndpointMethod::POST]);
        $this->endpointConfigMock->method('getPath')->willReturn("/users");

        $this->routerMock->expects($this->once())->method("addRoute")->with(
            ["POST"],
            "/users",
            "App\\Http\\Endpoints\\Users\\CreateUser"
        )->willReturn(new Route(["POST"], "/users", ["App\\Http\\Endpoints\\Users\\CreateUser"]));

        $instance = $this->getInstance();
        $instance->generate();

        $this->assertInstanceOf(Route::class, $instance->getRoute());
    }

    /**
     * @throws ReflectionException
     */
    public function test_getMethodsShouldReturnProvidedMethodsEnumsValuesAsString()
    {
        $instance = $this->getInstance();
        $reflector = new ReflectionClass($instance);

        $method = $reflector->getMethod("getMethods");

        $this->endpointConfigMock->method('getMethod')->willReturn([
            EnumEndpointMethod::PUT,
            EnumEndpointMethod::ANY,
            EnumEndpointMethod::OPTIONS,
        ]);
        $this->assertEquals(["PUT", "ANY", "OPTIONS"], $method->invoke($instance));
    }

    public function test_routePipesShouldNotBeExecutedIfRouteIsNotAdded()
    {
        $mock = $this->getMock()
            ->onlyMethods(["getRoute", "execPipes"])
            ->getMock();

        $mock->method("getRoute")->willReturn(null);
        $mock->expects($this->never())->method("execPipes");

        $mock->generate();
    }

    public function test_routePipesShouldBeExecutedIfRouteIsAdded()
    {
        $route = new Route("GET", "/test", ["TestController@action"]);

        $mock = $this->getMock()
            ->onlyMethods(["getRoute", "execPipes"])
            ->getMock();

        $mock->method("getRoute")->willReturn($route);
        $mock->expects($this->once())->method("execPipes")->willReturn($route);

        $this->assertInstanceOf(Route::class, $mock->generate());
    }

    public function test_routeShouldNotMergeNamespaceConfigIfNotDetected()
    {
       $mock = $this->getMock()
            ->onlyMethods(["getRoute", "detectNamespaceScopeConfig"])
            ->getMock();

        $mock->method("detectNamespaceScopeConfig")->willReturn(null);
        $mock->method("getRoute")->willReturn($this->getRoute());

        $this->endpointConfigMock
            ->expects($this->never())
            ->method("mergeCollection");

        $mock->generate();
    }

    public function test_routeShouldMergeNamespaceConfigIfDetected()
    {
        $mock = $this->getMock()
            ->onlyMethods(["getRoute", "detectNamespaceScopeConfig"])
            ->getMock();

        $mock->method("getRoute")->willReturn($this->getRoute());
        $mock->method("detectNamespaceScopeConfig")->willReturn([
            "config1" => ["name" => "test.name"],
            "config2" => ["whereAlpha" => "name"],
        ]);

        $this->endpointConfigMock
            ->expects($this->once())
            ->method("mergeCollection")
            ->with([
                "config1" => ["name" => "test.name"],
                "config2" => ["whereAlpha" => "name"],
            ]);

        $mock->generate();
    }

    public function test_namespaceConfigDetectionShouldBeNullIfEmptyPackageConfig()
    {
        Config::set("fast-endpoints.namespaces", null);

        $mock = $this->getMock()
            ->onlyMethods(["detectNamespaceScopeConfig"])
            ->getMock();

        $reflector = new ReflectionClass($mock);

        $this->assertNull(
            $reflector->getMethod("detectNamespaceScopeConfig")
                ->invoke($mock)
        );
    }

    public function test_namespaceConfigDetectionShouldBeEmptyBecauseNotMatchedNamespaces()
    {
        Config::set("fast-endpoints.namespaces", [
            "namespace1" => [
                "name" => "namespace.1",
            ],
            "namespace2" => [
                "whereAlpha" => "name",
            ],
        ]);

        $instance = $this->getInstance();
        $reflector = new ReflectionClass($instance);

        $this->assertEmpty(
            $reflector->getMethod("detectNamespaceScopeConfig")->invoke($instance)
        );
    }

    public function test_namespaceConfigDetectionShouldReturnTwoMatchedNamespaces()
    {
        Config::set("fast-endpoints.namespaces", [
            "App\\Http\\Endpoints" => [
                "middleware" => ["auth:api"],
            ],
            "App\\Http\\Endpoints\\Posts\\PostDelete" => [
                "can" => ["delete", "post"],
            ],
            "App\\Http\\Endpoints\\Users" => [
                "prefix" => "users",
                "name" => "users.actions",
            ],
            "App\\Http\\Endpoints\\Users\\CreateUser" => [
                "can" => ["create", "user"],
            ],
        ]);

        $instance = $this->getInstance();
        $reflector = new ReflectionClass($instance);

        $this->assertEquals(
            $reflector->getMethod("detectNamespaceScopeConfig")->invoke($instance),
            [
                [
                    "middleware" => ["auth:api"],
                ],
                [
                    "prefix" => "users",
                    "name" => "users.actions",
                ],
                [
                    "can" => ["create", "user"],
                ],
            ]
        );
    }
}