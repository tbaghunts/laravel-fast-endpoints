<?php

namespace Tests\Feature\Validations;

use Illuminate\Support\Str;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class WhereUuidTest extends ValidationTestCase
{
    protected function getPath(): string
    {
        return "/test/validation/where-uuid";
    }

    protected function getRequiredValue(): string
    {
        return Str::uuid()->toString();
    }

    protected function getSometimesValue(): string
    {
        return Str::uuid()->toString();
    }

    protected function getInvalidRequiredValue(): string
    {
        return "invalid-uuid-required";
    }

    protected function getInvalidSometimesValue(): string
    {
        return "invalid-uuid-sometimes";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::PUT;
    }
}