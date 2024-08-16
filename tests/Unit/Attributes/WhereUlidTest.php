<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\WhereUlid;

use Tests\Unit\Attributes\Abstract\SingleParametricWhereTestCase;

class WhereUlidTest extends SingleParametricWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereUlid::class;
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
        return "getWhereUlid";
    }
}