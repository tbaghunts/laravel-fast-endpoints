<?php

namespace Tests\Unit\Generator\Pipes\Abstract;

use PHPUnit\Framework\MockObject\Rule\InvokedCount;

use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

abstract class PipeBooleanDependentCallTestCase extends PipeTestCase
{
    protected abstract function getRouteMethodName(): string;
    protected abstract function getConfigMethodName(): string;

    protected function getDefaultValue(): bool
    {
        return false;
    }

    public function test_defaultCase()
    {
        $this->execCallTest($this->getDefaultValue());
    }

    public function test_falseCase()
    {
        $this->execCallTest(false);
    }

    public function test_trueCase()
    {
        $this->execCallTest(true);
    }

    private function execCallTest(bool $value): void
    {
        $this->endpointConfigMock
            ->method($this->getConfigMethodName())
            ->willReturn($value);

        $this->routeMock
            ->expects($this->getInvokedCount($value))
            ->method($this->getRouteMethodName());

        $this->handle();
    }

    private function getInvokedCount(bool $value): InvokedCount
    {
        return $value ? $this->once() : $this->never();
    }

}