<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Middleware;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

use Tests\Unit\Attributes\Abstract\TestCase;

class MiddlewareTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Middleware::class;
    }

    private function makeInstance(string|array $middleware): EndpointConfigContract
    {
        return $this->getInstance([
            "middleware" => $middleware
        ]);
    }

    public function test_shouldAddSingleMiddlewareToList()
    {
        $this->assertEquals(
            ["web"],
            $this->makeInstance("web")->getMiddleware()
        );
    }

    public function test_shouldAddMultiMiddlewareToList()
    {
        $this->assertEquals(
            ["web", "api", "auth"],
            $this->makeInstance(["web", "api", "auth"])->getMiddleware()
        );
    }
}