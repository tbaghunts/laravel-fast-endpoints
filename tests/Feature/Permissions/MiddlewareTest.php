<?php

namespace Tests\Feature\Permissions;

use Tests\Feature\Assets\Middlewares\SecureMiddleware;
use Tests\Feature\TestCase;

class MiddlewareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withMiddleware([
            SecureMiddleware::class
        ]);
    }

    public function test_middlewareShouldNotBeAccepted()
    {
        $this->get("/test/permissions/middleware/required/sometimes")
            ->assertStatus(403);
    }

    public function test_middlewareShouldBeAccepted()
    {
        $this->get("/test/permissions/middleware/secret/not-secret")
            ->assertStatus(200)
            ->assertJson([
                "method" => "GET",
                "data" => [
                    "required" => "secret",
                    "sometimes" => "not-secret"
                ]
            ]);
    }
}