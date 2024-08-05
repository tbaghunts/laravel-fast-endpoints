<?php

namespace Tests\Unit\Endpoint;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\BlockPipe;

use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class BlockPipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return BlockPipe::class;
    }

    public function test_routeShouldNotBeMarkedAsBlockIfConfigIsEmpty()
    {
        $this->endpointConfigMock
            ->method("getBlock")
            ->willReturn([]);

        $this->routeMock
            ->expects($this->never())
            ->method("block");

        $this->handle();
    }

    public function test_routeShouldBeMarkedAsBlockWithNullParameters()
    {
        $this->endpointConfigMock
            ->method("getBlock")
            ->willReturn([null, null]);

        $this->routeMock
            ->expects($this->once())
            ->method("block")
            ->with(null, null);

        $this->handle();
    }

    public function test_routeShouldBeMarkedAsBlockWithLockParamsOnly()
    {
        $this->endpointConfigMock
            ->method("getBlock")
            ->willReturn([23, null]);

        $this->routeMock
            ->expects($this->once())
            ->method("block")
            ->with(23, null);

        $this->handle();
    }

    public function test_routeShouldBeMarkedAsBlockWithWaitParamsOnly()
    {
        $this->endpointConfigMock
            ->method("getBlock")
            ->willReturn([null, 50]);

        $this->routeMock
            ->expects($this->once())
            ->method("block")
            ->with(null, 50);

        $this->handle();
    }

    public function test_routeShouldMarkedAsBlockWithBothParameters()
    {
        $this->endpointConfigMock
            ->method("getBlock")
            ->willReturn([100, 24]);

        $this->routeMock
            ->expects($this->once())
            ->method("block")
            ->with(100, 24);

        $this->handle();
    }
}