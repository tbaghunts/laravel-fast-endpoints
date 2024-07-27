<?php

namespace Tests\Unit\Generator\Pipes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use ReflectionClass;
use ReflectionException;

use Mockery;
use Mockery\MockInterface;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoint\Generator\RouteGenerator;
use Baghunts\LaravelFastEndpoint\Generator\Pipes\{
    RoutePipe,
    RouteDeclarationPipe
};
use Baghunts\LaravelFastEndpoint\Contracts\{
    EndpointConfigContract,
    RouteGeneratorContract
};

class RouteDeclarationPipeTest extends TestCase
{
    use RefreshDatabase;

    private MockInterface $endpointConfigStub;

    protected function setUp(): void
    {
        $this->endpointConfigStub = Mockery::mock(EndpointConfigContract::class);

        $this->afterApplicationCreated(function () {
            $this->app->bind(EndpointConfigContract::class, fn() => $this->endpointConfigStub);
            $this->app->bind(RouteGeneratorContract::class, RouteGenerator::class);
        });

        parent::setUp();
    }

    private function createInstance(): RoutePipe
    {
        return app(RouteDeclarationPipe::class);
    }

    private function createRouteGenerator(string $classNamespace = "RouteClassNamespace")
    {
        return app(RouteGeneratorContract::class, [
            "classNamespace" => $classNamespace,
            "config" => $this->endpointConfigStub,
        ]);
    }
    
    /**
     * @throws ReflectionException
     */
    private function getRouteGeneratorStatements(RouteGeneratorContract $routeGenerator): array
    {
        $reflector = new ReflectionClass($routeGenerator);
        return $reflector->getProperty('statements')->getValue($routeGenerator);
    }

    /**
     * @throws ReflectionException
     */
    public function test_handleWithoutMethod()
    {
        $this->endpointConfigStub->shouldReceive('getMethod')->andReturn([]);
        $this->endpointConfigStub->shouldReceive('getName')->andReturn("route.name");
        $this->endpointConfigStub->shouldReceive('getPath')->andReturn("/route/name");

        $this->execTest(
            expected: "# Route without methods (name: route.name, path: /route/name)"
        );
    }

    /**
     * @throws ReflectionException
     */
    public function test_handleWithSingleMethod()
    {

        $this->endpointConfigStub->shouldReceive('getPath')->andReturn("/route/name");
        $getMethodSpy = $this->endpointConfigStub->shouldReceive('getMethod');

        // With Get request method
        $getMethodSpy->andReturn([EnumEndpointMethod::GET]);
        $this->execTest(
            expected: "Route::get('/route/name',Route\Class\Namespace::class)",
            namespace: "Route\Class\Namespace"
        );

        // With Post request method
        $getMethodSpy->andReturn([EnumEndpointMethod::POST]);
        $this->execTest(
            expected: "Route::post('/route/name',Route\Class\Namespace\Store::class)",
            namespace: "Route\Class\Namespace\Store"
        );
    }

    /**
     * @throws ReflectionException
     */
    public function test_handleWithMultipleMethods()
    {
        $getMethodSpy = $this->endpointConfigStub->shouldReceive('getMethod');
        $this->endpointConfigStub->shouldReceive('getPath')->andReturn('/route/name/multiple');

        // put, patch, post example
        $getMethodSpy->andReturn([
            EnumEndpointMethod::PUT,
            EnumEndpointMethod::PATCH,
            EnumEndpointMethod::POST,
        ]);
        $this->execTest(
            expected: "Route::match(['put','patch','post'],'/route/name/multiple',Route\Class\Namespace\Update::class)",
            namespace: "Route\Class\Namespace\Update"
        );
        
        // head, get example
        $getMethodSpy->andReturn([
            EnumEndpointMethod::HEAD,
            EnumEndpointMethod::GET,
        ]);
        $this->execTest(
            expected: "Route::match(['head','get'],'/route/name/multiple',Route\Class\Namespace\Get::class)",
            namespace: "Route\Class\Namespace\Get"
        );
    }

    /**
     * @throws ReflectionException
     */
    public function test_handleWithoutPath()
    {
        $getPathStub = $this->endpointConfigStub->shouldReceive('getPath');
        $getMethodSpy = $this->endpointConfigStub->shouldReceive('getMethod');

        // With empty path
        $getPathStub->andReturn('');
        $getMethodSpy->andReturn([
            EnumEndpointMethod::ANY,
        ]);
        $this->execTest(
            expected: "Route::any('',Route\Class\WithoutPath::class)",
            namespace: "Route\Class\WithoutPath",
        );

        // With null path
        $getPathStub->andReturn(null);
        $getMethodSpy->andReturn([
            EnumEndpointMethod::DELETE,
            EnumEndpointMethod::OPTIONS,
        ]);
        $this->execTest(
            expected: "Route::match(['delete','options'],'',Route\Class\WithoutPath::class)",
            namespace: "Route\Class\WithoutPath",
        );
    }

    /**
     * @throws ReflectionException
     */
    private function execTest(
        string $expected,
        string $namespace = "RouteClassNamespace"
    ): void
    {
        $instance = $this->createInstance();
        $routeGenerator = $this->createRouteGenerator($namespace);

        $instance->handle($routeGenerator, fn() => null);

        $this->assertEquals(
            $expected,
            $this->getRouteGeneratorStatements($routeGenerator)[0],
        );
    }
}