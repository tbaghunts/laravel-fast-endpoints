<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\ScopeBindingsPipe;

use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class ScopeBindingsPipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return ScopeBindingsPipe::class;
    }

    public function test_routeShouldNotBeTriggeredForScopesBindingIfScopeBindingsIsNull()
    {
        $this->endpointConfigMock->method('getScopeBindings')->willReturn(null);

        $this->routeMock->expects($this->never())->method('scopeBindings');
        $this->routeMock->expects($this->never())->method('withoutScopedBindings');

        $this->handle();
    }

    public function test_routeShouldBeScopesBoundIfConfigIsTrue()
    {
        $this->endpointConfigMock->method('getScopeBindings')->willReturn(true);

        $this->routeMock->expects($this->once())->method('scopeBindings');
        $this->routeMock->expects($this->never())->method('withoutScopedBindings');

        $this->handle();
    }

    public function test_routeShouldSkipScopesBoundIfConfigIsFalse()
    {
        $this->endpointConfigMock->method('getScopeBindings')->willReturn(false);

        $this->routeMock->expects($this->never())->method('scopeBindings');
        $this->routeMock->expects($this->once())->method('withoutScopedBindings');

        $this->handle();
    }
}