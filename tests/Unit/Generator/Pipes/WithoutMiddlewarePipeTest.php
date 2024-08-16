<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\WithoutMiddlewarePipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class WithoutMiddlewarePipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return WithoutMiddlewarePipe::class;
    }

    public function test_routeShouldNotBeMarkedWithoutMiddlewareIfConfigIsEmpty()
    {
        $this->endpointConfigMock
            ->method('getWithoutMiddleware')
            ->willReturn([]);

        $this->routeMock->expects($this->never())->method("withoutMiddleware");

        $this->handle();
    }

    public function test_routeShouldMarkedWithoutMiddlewareIfConfigIsNotEmpty()
    {
        $this->endpointConfigMock
            ->method('getWithoutMiddleware')
            ->willReturn([
                'auth:api',
                'role:admin',
                'Middleware\\Handler\\Namespace'
            ]);

        $this->routeMock
            ->expects($this->once())
            ->method("withoutMiddleware")
            ->with([
                'auth:api',
                'role:admin',
                'Middleware\\Handler\\Namespace'
            ]);

        $this->handle();
    }
}