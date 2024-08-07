<?php

namespace Tests\Feature\RequestMethods;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class PostTest extends MethodTestCase
{
    protected function getUrl(): string
    {
        return "/test/post";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::POST;
    }
}