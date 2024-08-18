<?php

namespace Tests\Feature\Validations;

use Tests\Feature\TestCase;

class WhereInTest extends TestCase
{
    public function test_requiredParamShouldNotBeValidated()
    {
        $this->post('/test/validation/where-in/not-required/created_at')
            ->assertNotFound();
    }

    public function test_sometimesParamShouldNotBeValidated()
    {
        $this->post('/test/validation/where-in/id/invalid-param')
            ->assertNotFound();
    }

    public function test_allParamsShouldBeValidated()
    {
        $this->post('/test/validation/where-in/uuid/updated_at')
            ->assertStatus(200)
            ->assertJson([
                "required" => "uuid",
                "sometimes" => "updated_at",
            ]);

        $this->post('/test/validation/where-in/id/created_at')
            ->assertStatus(200)
            ->assertJson([
                "required" => "id",
                "sometimes" => "created_at",
            ]);

        $this->post('/test/validation/where-in/uuid')
            ->assertStatus(200)
            ->assertJson([
                "required" => "uuid",
                "sometimes" => null,
            ]);
    }

}