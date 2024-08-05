<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\WithoutBlockingPipe;

use Tests\Unit\Generator\Pipes\Abstract\PipeBooleanDependentCallTestCase;

class WithoutBlockingPipeTest extends PipeBooleanDependentCallTestCase
{
    protected function getNamespace(): string
    {
        return WithoutBlockingPipe::class;
    }

    protected function getConfigMethodName(): string
    {
        return "getWithoutBlocking";
    }

    protected function getRouteMethodName(): string
    {
        return "withoutBlocking";
    }
}