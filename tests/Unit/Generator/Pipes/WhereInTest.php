<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Generator\Pipes\WhereInPipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeWhereTestCase;

class WhereInTest extends PipeWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereInPipe::class;
    }

    protected function getConfigPropertyGetterName(): string
    {
        return "getWhereIn";
    }

    protected function getRouteMethodName(): string
    {
        return "whereIn";
    }

    protected function getValues(): array
    {
        return [
            ["status", ["pending", "progress", "done"]],
            ["is_active", [0, 1]],
        ];
    }
}