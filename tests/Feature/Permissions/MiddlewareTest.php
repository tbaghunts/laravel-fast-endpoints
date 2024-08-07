<?php

namespace Baghunts\tests\Feature\Permissions;

use Tests\Feature\TestCase;
use Tests\Feature\Assets\SecureMiddleware;

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