<?php

namespace Tests\Feature\RequestMethods;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class OptionsTest extends MethodTestCase
{
    protected function getUrl(): string
    {
        return "/test/options";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::OPTIONS;
    }
}