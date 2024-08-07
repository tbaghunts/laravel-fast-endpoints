<?php

namespace Tests\Feature\RequestMethods;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class RouteTest extends MethodTestCase
{
    protected function getUrl(): string
    {
        return "/test/route";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::POST;
    }
}