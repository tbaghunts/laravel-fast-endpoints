<?php

namespace Tests\Feature\Binding;

use Baghunts\tests\Feature\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\TestCase;

class WithTrashedTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

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
        $this->get('/test/validation/with-trashed/' . $this->user->id)
            ->assertStatus(200)
            ->assertJson([
                "id" => $this->user->id,
                "name" => $this->user->name,
                "surname" => $this->user->surname,
            ]);
    }

}