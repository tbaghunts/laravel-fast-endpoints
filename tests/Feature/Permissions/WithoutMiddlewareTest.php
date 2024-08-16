<?php

namespace Tests\Feature\Permissions;

use Tests\Feature\TestCase;
use Tests\Feature\Assets\Middlewares\SecureMiddleware;

class WithoutMiddlewareTest extends TestCase
{

    protected function getFastEndpointsConfig(): array
    {
        return [
            "middleware" => [
                SecureMiddleware::class,
            ],
        ];
    }

    public function test_namedRouteShouldNotBeAvailableBecauseGlobalMiddleware()
    {
        $this->get(route('echo'))
            ->assertStatus(403);
    }

    public function test_withoutMiddlewareShouldBeAvailable()
    {
        $this->post('/test/permissions/without-middleware/111/222')
            ->assertStatus(200)
            ->assertJson([
                "method" => "POST",
                "data" => [
                    "required" => "111",
                    "sometimes" => "222",
                ],
            ]);
    }
}