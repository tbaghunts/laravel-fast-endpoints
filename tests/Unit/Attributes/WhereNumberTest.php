<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoints\Attributes\WhereNumber;

use Tests\Unit\Attributes\Abstract\SingleParametricWhereTestCase;

class WhereNumberTest extends SingleParametricWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereNumber::class;
    }

    protected function getMethodName(): string
    {
        return 'getWhereNumber';
    }

    protected function getSingleValue(): string
    {
        return "id";
    }

    protected function getMultipleValues(): array
    {
        return ["id", "age", "status"];
    }
}