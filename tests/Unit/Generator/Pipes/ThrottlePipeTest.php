<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Generator\Pipes\ThrottlePipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class ThrottlePipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return ThrottlePipe::class;
    }

    public function test_routeShouldNotBeMarkedAsThrottledIfConfigIsEmpty()
    {
        $this->endpointConfigMock
            ->method('getThrottles')
            ->willReturn([]);

        $this->routeMock
            ->expects($this->never())
            ->method('middleware');

        $this->handle();
    }

    public function test_routeShouldBeMarkedAsThrottled()
    {
        $this->endpointConfigMock
            ->method('getThrottles')
            ->willReturn([
                [
                    'requests' => 10,
                    'perMinute' => 2,
                ]
            ]);

        $this->routeMock
            ->expects($this->once())
            ->method('middleware')
            ->with([
                'throttle:10,2'
            ]);

        $this->handle();
    }

    public function test_routeShouldMarkedAsBlockWithMultipleParameters()
    {
        $this->endpointConfigMock
            ->method("getThrottles")
            ->willReturn([
                [
                    'requests' => 1,
                    'perMinute' => 2,
                ],
                [
                    'requests' => 10,
                    'perMinute' => 20,
                ]
            ]);

        $this->routeMock
            ->expects($this->once())
            ->method("middleware")
            ->with([
                'throttle:1,2',
                'throttle:10,20'
            ]);

        $this->handle();
    }
}