<?php

namespace Tests\Feature\RequestMethods;

use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

class DeleteTest extends MethodTestCase
{
    protected function getUrl(): string
    {
        return "/test/delete";
    }

    protected function getMethod(): EnumEndpointMethod
    {
        return EnumEndpointMethod::DELETE;
    }
}