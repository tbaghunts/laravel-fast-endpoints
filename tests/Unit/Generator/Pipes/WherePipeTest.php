<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\WherePipe;

use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class WherePipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return WherePipe::class;
    }

    public function test_routeShouldNotBeMarkedWithWhereRulesIfConfigIsEmpty()
    {
        $this->endpointConfigMock->method("getWhere")->willReturn([]);
        $this->routeMock->expects($this->never())->method('where');

        $this->handle();
    }

    public function test_routeShouldBeMarkedWithWhereRulesFromConfig()
    {
        $this->endpointConfigMock->method("getWhere")->willReturn([
            "in" => [1, 2],
            "guid" => "uuid",
            "name" => "string",
        ]);
        $this->routeMock->expects($this->once())->method('setWheres')->with([
            "in" => [1, 2],
            "guid" => "uuid",
            "name" => "string",
        ]);

        $this->handle();
    }
}