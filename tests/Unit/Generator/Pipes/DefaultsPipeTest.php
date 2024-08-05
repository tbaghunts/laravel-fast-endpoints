<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\DefaultsPipe;

use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class DefaultsPipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return DefaultsPipe::class;
    }

    public function test_routeShouldNotBeMarkedWithDefaultsValuesIfConfigIsEmpty()
    {
        $this->endpointConfigMock->method('getDefaults')->willReturn([]);

        $this->routeMock->expects($this->never())->method('setDefaults');

        $this->handle();
    }

    public function test_routeShouldBeMarkedWithDefaultsIfConfigNotEmpty()
    {
        $this->endpointConfigMock->method('getDefaults')->willReturn([
            "user" => 1,
            "action" => "block"
        ]);

        $this->routeMock->expects($this->once())->method('setDefaults')->with([
            "user" => 1,
            "action" => "block"
        ]);

        $this->handle();
    }
}