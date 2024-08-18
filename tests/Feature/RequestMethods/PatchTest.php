<?php

namespace Tests\Feature\RequestMethods;

use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

class PatchTest extends MethodTestCase
{
    protected function getUrl(): string
    {
        return "/test/patch";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::PATCH;
    }
}