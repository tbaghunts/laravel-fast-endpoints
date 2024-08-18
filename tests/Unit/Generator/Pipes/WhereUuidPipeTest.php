<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Generator\Pipes\WhereUuidPipe;
use Tests\Unit\Generator\Pipes\Abstract\PipeWhereTestCase;

class WhereUuidPipeTest extends PipeWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereUuidPipe::class;
    }

    protected function getRouteMethodName(): string
    {
        return "whereUuid";
    }

    protected function getConfigPropertyGetterName(): string
    {
        return "getWhereUuid";
    }

    protected function getValues(): array
    {
        return [
            "uuid",
            "guid",
            "session_guid",
            "session_uuid",
            "transaction_key",
        ];
    }
}