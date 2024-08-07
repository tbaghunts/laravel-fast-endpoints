<?php

namespace Tests\Feature\Binding;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\Feature\TestCase;
use Tests\Feature\Models\User;

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

        // TODO: Write with trashed cases
        $this->assertTrue(true);

//        $this->get('/test/validation/with-trashed/' . $this->user->id)
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                "id" => $this->user->id,
//                "name" => $this->user->name,
//                "surname" => $this->user->surname,
//            ]);
    }

}