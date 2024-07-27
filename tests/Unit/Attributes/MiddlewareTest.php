<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Middleware;

use Tests\Unit\Attributes\Abstract\TestCase;

class MiddlewareTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Middleware::class;
    }

    public function test_shouldAddSingleMiddlewareToList()
    {
        $this->assertEquals(
            ["web"],
            $this->getInstance(["web"])->getMiddleware()
        );
    }

    public function test_shouldAddMultiMiddlewareToList()
    {
        $this->assertEquals(
            ["web", "api", "auth"],
            $this->getInstance(["web", "api", "auth"])->getMiddleware()
        );
    }
}