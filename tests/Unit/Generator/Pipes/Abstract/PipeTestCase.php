<?php

namespace Tests\Unit\Generator\Pipes\Abstract;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoints\Contracts\RouteGeneratorContract;
use Baghunts\LaravelFastEndpoints\Generator\Pipes\RoutePipe;
use Closure;
use Illuminate\Routing\Route;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;

abstract class PipeTestCase extends TestCase
{
    protected ?MockObject $routeMock;
    protected ?MockObject $endpointConfigMock;
    protected ?MockObject $routeGeneratorMock;

    abstract protected function getNamespace(): string;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->routeMock = $this->createMock(Route::class);
        $this->endpointConfigMock = $this->createMock(EndpointConfigContract::class);
        $this->routeGeneratorMock = $this->getMockBuilder(RouteGeneratorContract::class)
            ->setConstructorArgs([
                $this->routeMock,
                "Pipe\\TestCase",
                $this->endpointConfigMock
            ])->getMock();
    }

    protected function getInstance(): RoutePipe
    {
        $this->routeGeneratorMock
            ->method("getEndpointConfiguration")
            ->willReturn($this->endpointConfigMock);

        $this->routeGeneratorMock
            ->method("getRoute")
            ->willReturn($this->routeMock);

        return app($this->getNamespace());
    }

    protected function handle(?Closure $next = null): void
    {
        if (!$next) {
            $next = fn($generator) => null;
        }


        $this->getInstance()->handle(
            $this->routeGeneratorMock,
            $next,
        );
    }

    public function test_pipeNextClosureShouldBeCalledWithGenerator()
    {
        $arg = null;
        $called = false;

        $this->handle(function($param) use (&$called, &$arg) {
            $called = true;
            $arg = $param;
        });

        $this->assertTrue($called);
        $this->assertInstanceOf(RouteGeneratorContract::class, $arg);
    }
    
}