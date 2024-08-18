<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoints\Attributes\WhereAlpha;

use Tests\Unit\Attributes\Abstract\SingleParametricWhereTestCase;

class WhereAlphaTest extends SingleParametricWhereTestCase
{
    protected function getNamespace(): string
    {
        return WhereAlpha::class;
    }

    protected function getSingleValue(): string
    {
        return "name";
    }

    protected function getMultipleValues(): array
    {
        return ["username", "password"];
    }

    protected function getMethodName(): string
    {
        return "getWhereAlpha";
    }
}