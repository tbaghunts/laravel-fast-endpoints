<?php

namespace Tests\Feature\Validations;

use Illuminate\Support\Str;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class WhereUlidTest extends ValidationTestCase
{
    protected function getPath(): string
    {
        return "/test/validation/where-ulid";
    }

    protected function getRequiredValue(): string
    {
        return Str::ulid()->toString();
    }

    protected function getSometimesValue(): string
    {
        return Str::ulid()->toString();
    }

    protected function getInvalidRequiredValue(): int
    {
        return 294;
    }

    protected function getInvalidSometimesValue(): string
    {
        return "invalid";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::DELETE;
    }
}