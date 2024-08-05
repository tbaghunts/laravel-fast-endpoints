<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\FallbackPipe;

use Tests\Unit\Generator\Pipes\Abstract\PipeBooleanDependentCallTestCase;

class FallbackPipeTest extends PipeBooleanDependentCallTestCase
{

    protected function getNamespace(): string
    {
        return FallbackPipe::class;
    }

    protected function getConfigMethodName(): string
    {
        return "getFallback";
    }

    protected function getRouteMethodName(): string
    {
        return "fallback";
    }
}