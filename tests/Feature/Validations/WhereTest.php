<?php

namespace Tests\Feature\Validations;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class WhereTest extends ValidationTestCase
{
    protected function getPath(): string
    {
        return "/test/validation/where";
    }

    protected function getRequiredValue(): int
    {
        return 20;
    }

    protected function getSometimesValue(): string
    {
        return "sometimes-value";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::GET;
    }

    protected function getInvalidRequiredValue(): string
    {
        return "required-value";
    }

    protected function getInvalidSometimesValue(): int
    {
        return 183;
    }
}