<?php

namespace Tests\Unit\Generator\Pipes\Abstract;

abstract class PipeWhereTestCase extends PipeTestCase
{
    protected abstract function getValues(): array;
    protected abstract function getRouteMethodName(): string;
    protected abstract function getConfigPropertyGetterName(): string;

    public function test_routeShouldNotContainRuleIfConfigIsEmpty()
    {
        $this->endpointConfigMock->method($this->getConfigPropertyGetterName())->willReturn([]);
        $this->routeMock->expects($this->never())->method($this->getRouteMethodName());

        $this->handle();
    }

    public function test_routeShouldBeMarkedOnceAsWhereRuleIfConfigHasSingleValue()
    {
        $singleValueArray = collect($this->getValues())->random();

        $this->endpointConfigMock
            ->method($this->getConfigPropertyGetterName())
            ->willReturn([$singleValueArray]);

        if (!is_array($singleValueArray)) {
            $singleValueArray = [$singleValueArray];
        }

        $this->routeMock
            ->expects($this->once())
            ->method($this->getRouteMethodName())
            ->with(...$singleValueArray);

        $this->handle();
    }

    public function test_routeShouldBeMarkedMultipleTimeAsWhereRuleIfConfigHasMultipleValues()
    {
        $expectedValues = $this->getValues();

        $this->endpointConfigMock
            ->method($this->getConfigPropertyGetterName())
            ->willReturn($expectedValues);

        $this->routeMock
            ->expects($this->exactly(count($expectedValues)))
            ->method($this->getRouteMethodName())
            ->willReturnCallback(function (...$args) use ($expectedValues) {
                static $index = 0;

                $value = $expectedValues[$index];
                if (!is_array($value)) {
                    $value = [$value];
                }

                $this->assertEquals($value, $args);

                ++$index;
            });

        $this->handle();
    }
}