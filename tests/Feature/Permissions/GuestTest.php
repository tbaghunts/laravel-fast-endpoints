<?php

namespace Tests\Feature\Permissions;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\Feature\TestCase;
use Tests\Feature\Assets\Models\User;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->create([
            "name" => "UserName",
            "surname" => "UserSurname",
        ]);
    }

    public function test_guestRequestShouldBeAccepted()
    {
        $this->post("/test/permissions/guest", [
            "key" => "value"
        ])->assertStatus(200)
        ->assertJson([
            "method" => "POST",
            "data" => [
                "key" => "value"
            ],
        ]);
    }

    public function test_guestRequestShouldNotBeAcceptedWithAuthenticatedUser()
    {
        $this->actingAs($this->user)
            ->post("/test/permissions/guest")
            ->assertStatus(302)
            ->assertRedirect(url('/'));
    }
}