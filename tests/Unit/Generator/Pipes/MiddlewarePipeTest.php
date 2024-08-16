<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\MiddlewarePipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class MiddlewarePipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return MiddlewarePipe::class;
    }

    public function test_routeShouldNotBeMarkedWithRouteIfConfigIsEmpty()
    {
        $this->endpointConfigMock
            ->method("getMiddleware")
            ->willReturn([]);

        $this->routeMock
            ->expects($this->never())
            ->method("middleware");

        $this->handle();
    }

    public function test_routeShouldBeMarkedWithMiddlewareIfConfigIsNotEmpty()
    {
        $this->endpointConfigMock
            ->method("getMiddleware")
            ->willReturn([
                "auth:api",
                "role:admin",
                "App\\Middleware\\TestMiddleware"
            ]);

        $this->routeMock
            ->expects($this->once())
            ->method("middleware")
            ->with([
                "auth:api",
                "role:admin",
                "App\\Middleware\\TestMiddleware"
            ]);

        $this->handle();
    }
}