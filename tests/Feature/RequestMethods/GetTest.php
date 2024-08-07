<?php

namespace Tests\Feature\RequestMethods;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class GetTest extends MethodTestCase
{
    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::GET;
    }

    protected function getUrl(): string
    {
        return "/test/get";
    }
}