<?php

namespace Tests\Feature\Binding;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Middleware\SubstituteBindings;

use Tests\Feature\TestCase;
use Tests\Feature\Assets\Models\User;

class WithTrashedTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    protected function getFastEndpointsConfig(): array
    {
        return [
            "middleware" => [
                SubstituteBindings::class,
            ]
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->create([
            'name' => 'Name',
            'surname' => 'Surname',
        ]);
    }

    public function test_recordShouldBeFoundIfNotTrashed()
    {
        $this->doRequest();
    }

    public function test_recordShouldBeFoundIfTrashed()
    {
        $this->user->delete();

        $this->doRequest();
    }

    public function doRequest(): void
    {
        $this->get('/test/validation/with-trashed/' . $this->user->id)
            ->assertStatus(200)
            ->assertJson([
                "id" => $this->user->id,
                "name" => $this->user->name,
                "surname" => $this->user->surname,
            ]);
    }
}