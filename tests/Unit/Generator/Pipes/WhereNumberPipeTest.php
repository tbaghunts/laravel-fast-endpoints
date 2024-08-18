<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Generator\Pipes\WhereNumberPipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeWhereTestCase;

class WhereNumberPipeTest extends PipeWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereNumberPipe::class;
    }

    protected function getRouteMethodName(): string
    {
        return "whereNumber";
    }

    protected function getConfigPropertyGetterName(): string
    {
        return "getWhereNumber";
    }

    protected function getValues(): array
    {
        return [
            "id",
            "age",
            "count",
            "index",
        ];
    }
}