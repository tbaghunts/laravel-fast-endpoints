<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\CanPipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class CanPipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return CanPipe::class;
    }

    public function test_routeShouldNotBeMarkedWithCanIfConfigIsEmpty()
    {
        $this->endpointConfigMock
            ->method('getCan')
            ->willReturn([]);

        $this->routeMock
            ->expects($this->never())
            ->method("can");

        $this->handle();
    }

    public function test_routeShouldBeMarkedWithCanOnceIfConfigContainsSingle()
    {
        $this->endpointConfigMock
            ->method('getCan')
            ->willReturn([
                "update" => "App\\Models\\User"
            ]);

        $this->routeMock
            ->expects($this->once())
            ->method("can")
            ->with( "update", "App\\Models\\User");

        $this->handle();
    }

    public function test_routeShouldBeMarkedWithCanMultipleTimeIfConfigContainsMultiple()
    {
        $data = [
            "update" => "App\\Models\\User",
            "delete" => [
                "App\\Models\\User",
                "App\\Models\\Posts"
            ],
            "create" => [
                "App\\Models\\Payment",
            ]
        ];

        $this->endpointConfigMock
            ->method('getCan')
            ->willReturn($data);

        $this->routeMock
            ->expects($this->exactly(3))
            ->method("can")
            ->willReturnCallback(function (array|string $ability, array|string|null $models) use ($data) {
                static $index = 0;

                if (is_string($ability)) {
                    $ability = [$ability => $models];
                }

                $keys = array_keys($data);
                $values = array_values($data);

                $key = $keys[$index];
                $value = $values[$index];

                $this->assertEquals($ability, [$key => $value]);

                $index++;
            });

        $this->handle();
    }
}