<?php

namespace Tests\Feature\Basic;

use Illuminate\Testing\TestResponse;

use Tests\Feature\TestCase;

class DefaultsTest extends TestCase
{
    public function test_parametersShouldBeWithDefaultValues()
    {
        $this->request()
            ->assertStatus(200)
            ->assertJson([
                "required" => "req",
                "sometimes" => 1030,
            ]);
    }

    public function test_sometimesShouldBeWithDefaultsValue()
    {
        $this->request(
            required: "this-is-a-required-value",
        )
            ->assertStatus(200)
            ->assertJson([
                "required" => "this-is-a-required-value",
                "sometimes" => 1030,
            ]);
    }

    public function test_botValuesShouldReturnProvidedValues()
    {
        $this->request(
            required: 12,
            sometimes: 21,
        )
            ->assertStatus(200)
            ->assertJson([
                "required" => 12,
                "sometimes" => 21,
            ]);
    }

    private function request(
        mixed $required = "",
        mixed $sometimes = ""
    ): TestResponse
    {
        $url = sprintf(
            "/test/basic/defaults/%s%s",
            $required,
            $sometimes ? "/{$sometimes}" : ""
        );

        return $this->get($url);
    }
}