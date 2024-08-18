<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoints\Attributes\WhereUuid;

use Tests\Unit\Attributes\Abstract\SingleParametricWhereTestCase;

class WhereUuidTest extends SingleParametricWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereUuid::class;
    }

    protected function getSingleValue(): string
    {
        return "param";
    }

    protected function getMultipleValues(): array
    {
        return ["first-param", "second-param"];
    }

    protected function getMethodName(): string
    {
        return "getWhereUuid";
    }
}