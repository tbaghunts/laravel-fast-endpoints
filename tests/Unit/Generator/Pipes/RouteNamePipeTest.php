<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\RouteNamePipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class RouteNamePipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return RouteNamePipe::class;
    }

    public function test_routeShouldNotBeNamedIfConfigNameIsNull()
    {
        $this->nonCallTestCaseExecution(null);
    }

    public function test_routeShouldNotBeNamedIfConfigNameIsEmptyString()
    {
        $this->nonCallTestCaseExecution('');
    }

    public function test_routeShouldBeNamedIfConfigNameIsActualStringValue()
    {
        $this->endpointConfigMock->method("getName")->willReturn("test.case");

        $this->routeMock->expects($this->once())
            ->method('name')
            ->with("test.case");

        $this->handle();
    }

    protected function nonCallTestCaseExecution(?string $value): void
    {
        $this->endpointConfigMock->method('getName')
            ->willReturn($value);

        $this->routeMock->expects($this->never())
            ->method('name');

        $this->handle();
    }
}