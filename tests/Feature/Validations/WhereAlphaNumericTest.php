<?php

namespace Tests\Feature\Validations;

use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

class WhereAlphaNumericTest extends ValidationTestCase
{
    protected function getPath(): string
    {
        return "/test/validation/where-alpha-numeric";
    }

    protected function getRequiredValue(): string
    {
        return "abc";
    }

    protected function getSometimesValue(): string
    {
        return "abc123";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::POST;
    }

    protected function getInvalidRequiredValue(): string
    {
        return "abc123";
    }

    protected function getInvalidSometimesValue(): string
    {
        return "abc-123";
    }
}