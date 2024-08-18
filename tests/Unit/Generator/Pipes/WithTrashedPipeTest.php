<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Generator\Pipes\WithTrashedPipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeBooleanDependentCallTestCase;

class WithTrashedPipeTest extends PipeBooleanDependentCallTestCase
{
    protected function getNamespace(): string
    {
        return WithTrashedPipe::class;
    }

    protected function getConfigMethodName(): string
    {
        return "getWithTrashed";
    }

    protected function getRouteMethodName(): string
    {
        return "withTrashed";
    }
}