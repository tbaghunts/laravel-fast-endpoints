<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\WhereAlphaNumeric;

use Tests\Unit\Attributes\Abstract\SingleParametricWhereTestCase;

class WhereAlphaNumericTest extends SingleParametricWhereTestCase
{

    protected function getNamespace(): string
    {
        return WhereAlphaNumeric::class;
    }

    protected function getMethodName(): string
    {
        return 'getWhereAlphaNumeric';
    }

    protected function getSingleValue(): string
    {
        return "sku";
    }

    protected function getMultipleValues(): array
    {
        return ["sku", "uuid"];
    }
}