<?php

namespace Tests\Feature\RequestMethods;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

class AnyTest extends MethodTestCase
{
    public function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::ANY;
    }

    protected function getUrl(): string
    {
        return "/test/any";
    }
}