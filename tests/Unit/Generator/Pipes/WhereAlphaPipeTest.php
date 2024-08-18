<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Generator\Pipes\WhereAlphaPipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeWhereTestCase;

class WhereAlphaPipeTest extends PipeWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereAlphaPipe::class;
    }

    protected function getRouteMethodName(): string
    {
        return "whereAlpha";
    }

    protected function getConfigPropertyGetterName(): string
    {
        return "getWhereAlpha";
    }

    protected function getValues(): array
    {
        return [
            "first_name",
            "last_name",
        ];
    }
}