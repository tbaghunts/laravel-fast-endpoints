<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Route;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

use Tests\Unit\Attributes\Abstract\TestCase;

class RouteTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Route::class;
    }

    public function test_method()
    {
        $config = $this->getInstance(["/route/with/single/method", EnumEndpointMethod::POST]);

        $this->assertEquals(
            [EnumEndpointMethod::POST],
            $config->getMethod()
        );
        $this->assertEquals(
            "/route/with/single/method",
            $config->getPath()
        );
    }

    public function test_methods()
    {
        $config = $this->getInstance([
            "/route/with/multi/methods",
            EnumEndpointMethod::GET,
            EnumEndpointMethod::POST,
            [EnumEndpointMethod::DELETE, EnumEndpointMethod::OPTIONS]
        ]);

        $this->assertEquals(
            [
                EnumEndpointMethod::GET,
                EnumEndpointMethod::POST,
                EnumEndpointMethod::DELETE,
                EnumEndpointMethod::OPTIONS,
            ],
            $config->getMethod()
        );
        $this->assertEquals(
            "/route/with/multi/methods",
            $config->getPath()
        );
    }
}