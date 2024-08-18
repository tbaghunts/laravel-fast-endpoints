<?php

namespace Tests\Feature\Permissions;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\Feature\TestCase;
use Tests\Feature\Assets\Models\User;

class CanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Gate::define('update-permission', function (User $user) {
            return !!$user->is_admin;
        });
    }

    public function test_regularUserShouldNotHavePermission()
    {
        $user = User::query()->create([
            "name" => "Regular",
            "surname" => "User",
        ]);

        $this->actingAs($user)
            ->put('/test/permissions/can/111/222')
            ->assertStatus(403);
    }

    public function test_regularUserShouldHavePermission()
    {
        $user = User::query()->create([
            "is_admin" => 1,
            "name" => "Regular",
            "surname" => "User",
        ]);

        $this->actingAs($user)
            ->put('/test/permissions/can/111/222')
            ->assertStatus(200)
            ->assertJson([
                "method" => "PUT",
                "data" => [
                    "required" => "111",
                    "sometimes" => "222",
                ]
            ]);
    }
    
}