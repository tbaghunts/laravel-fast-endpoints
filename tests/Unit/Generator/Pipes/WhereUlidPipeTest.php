<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\WhereUlidPipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeWhereTestCase;

class WhereUlidPipeTest extends PipeWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereUlidPipe::class;
    }

    protected function getRouteMethodName(): string
    {
        return "whereUlid";
    }

    protected function getConfigPropertyGetterName(): string
    {
        return "getWhereUlid";
    }

    protected function getValues(): array
    {
        return [
            "key",
            "uuid",
            "guid",
        ];
    }
}