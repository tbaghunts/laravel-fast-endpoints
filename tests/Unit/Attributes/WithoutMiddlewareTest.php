<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\WithoutMiddleware;

use Tests\Unit\Attributes\Abstract\TestCase;

class WithoutMiddlewareTest extends TestCase
{
    protected function getNamespace(): string
    {
        return WithoutMiddleware::class;
    }

    public function test_defaultCase()
    {
        $this->assertEmpty($this->endpointConfig->getWithoutMiddleware());
    }

    public function test_singleValueCase()
    {
        $this->getInstance([
            "middleware" => "SingleMiddleware"
        ]);

        $this->assertEquals(["SingleMiddleware"], $this->endpointConfig->getWithoutMiddleware());
    }

    public function test_multipleValueCase()
    {
        $this->getInstance([
            "middleware" => [
                "auth.basic",
                "auth.basic.user",
                "role:amin"
            ],
        ]);

        $this->assertEquals([
            "auth.basic",
            "auth.basic.user",
            "role:amin"
        ], $this->endpointConfig->getWithoutMiddleware());
    }

    public function test_repeatableAttributeCase()
    {
        $this->getInstance([
            "middleware" => "api:auth"
        ]);
        $this->getInstance([
            "middleware" => "role:admin"
        ]);
        $this->getInstance([
            "middleware" => [
                "permission:create",
                "permission:delete"
            ]
        ]);

        $this->assertEquals([
            "api:auth",
            "role:admin",
            "permission:create",
            "permission:delete",
        ], $this->endpointConfig->getWithoutMiddleware());
    }
}