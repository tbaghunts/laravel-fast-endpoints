<?php

namespace Tests\Feature\RequestMethods;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class PutTest extends MethodTestCase
{
    protected function getUrl(): string
    {
        return "/test/put";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::PUT;
    }
}