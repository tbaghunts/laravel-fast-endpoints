<?php

namespace Baghunts\tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\WhereAlphaNumericPipe;

use Tests\Unit\Generator\Pipes\Abstract\PipeWhereTestCase;

class WhereAlphaNumericPipeTest extends PipeWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereAlphaNumericPipe::class;
    }

    protected function getRouteMethodName(): string
    {
        return "whereAlphaNumeric";
    }

    protected function getConfigPropertyGetterName(): string
    {
        return "getWhereAlphaNumeric";
    }

    protected function getValues(): array
    {
        return [
            "SKU",
            "username",
            "nickname",
        ];
    }
}