<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Route;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

use Tests\Unit\Attributes\Abstract\TestCase;

class RouteTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Route::class;
    }

    private function makeInstance(string $path, ...$args): EndpointConfigContract
    {
        return $this->getInstance([
            "path" => $path,
            "args" => $args,
        ]);
    }

    public function test_method()
    {
        $config = $this->makeInstance(
            "/route/with/single/method",
            EnumEndpointMethod::POST
        );

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
        $config = $this->makeInstance(
            "/route/with/multi/methods",
            EnumEndpointMethod::GET,
            EnumEndpointMethod::POST,
            [EnumEndpointMethod::DELETE, EnumEndpointMethod::OPTIONS]
        );

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