<?php

namespace Tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class EndpointConfigMiddlewareTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeEmptyMiddlewares()
    {
        $this->assertEquals([], $this->endpointConfig->getMiddleware());
    }
    public function test_shouldBeAbilityToSetupMiddlewares()
    {
        $this->endpointConfig->setMiddleware(["web", "auth:web"]);
        $this->assertEquals(["web", "auth:web"], $this->endpointConfig->getMiddleware());

        $this->endpointConfig->setMiddleware(["api", "auth:sanctum"]);
        $this->assertEquals(["api", "auth:sanctum"], $this->endpointConfig->getMiddleware());
    }
    public function test_shouldBeAbilityToInsertMiddlewareToExistList()
    {
        $this->endpointConfig->setMiddleware(["web", "auth:web"]);
        $this->assertEquals(["web", "auth:web"], $this->endpointConfig->getMiddleware());

        $this->endpointConfig->addMiddleware("hmac:valid");
        $this->assertEquals(
            ["web", "auth:web", "hmac:valid"],
            $this->endpointConfig->getMiddleware()
        );

        $this->endpointConfig->addMiddleware("role:admin");
        $this->assertEquals(
            ["web", "auth:web", "hmac:valid", "role:admin"],
            $this->endpointConfig->getMiddleware()
        );
    }
    public function test_shouldBeAbilityToInsertMultipleMiddlewareToExistList()
    {
        $this->endpointConfig->setMiddleware(["web", "auth:web"]);
        $this->assertEquals(["web", "auth:web"], $this->endpointConfig->getMiddleware());

        $this->endpointConfig->addMiddleware([
            "hmac:valid",
            "role:admin",
        ]);
        $this->assertEquals(
            ["web", "auth:web", "hmac:valid", "role:admin"],
            $this->endpointConfig->getMiddleware()
        );
    }
}