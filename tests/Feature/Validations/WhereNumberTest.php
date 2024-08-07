<?php

namespace Tests\Feature\Validations;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class WhereNumberTest extends ValidationTestCase
{
    protected function getPath(): string
    {
        return "/test/validation/where-number";
    }

    protected function getRequiredValue(): int
    {
        return 143;
    }

    protected function getSometimesValue(): int
    {
        return 10766;
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::POST;
    }

    protected function getInvalidRequiredValue(): string
    {
        return "invalid-number";
    }

    protected function getInvalidSometimesValue(): string
    {
        return "invalid-sometimes-number";
    }
}