<?php

namespace Tests\Feature\Validations;

use Illuminate\Testing\TestResponse;

use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

use Tests\Feature\TestCase;

abstract class ValidationTestCase extends TestCase
{
    private mixed $required;
    private mixed $sometimes;
    protected abstract function getPath(): string;
    protected abstract function getRequiredValue(): mixed;
    protected abstract function getSometimesValue(): mixed;
    protected abstract function getMethod(): EnumEndpointMethod;
    protected abstract function getInvalidRequiredValue(): mixed;
    protected abstract function getInvalidSometimesValue(): mixed;

    protected function setUp(): void
    {
        parent::setUp();

        $this->required = $this->getRequiredValue();
        $this->sometimes = $this->getSometimesValue();
    }

    public function test_requiredParameterShouldNotBeValid()
    {
        $this->request(
            required: $this->getInvalidRequiredValue(),
            sometimes: $this->sometimes,
        )->assertNotFound();
    }

    public function test_sometimesParameterShouldNotBeValid()
    {
        $this->request(
            required: $this->required,
            sometimes: $this->getInvalidSometimesValue(),
        )->assertNotFound();
    }

    public function test_requiredParameterShouldBeValid()
    {
        $this->request(
            required: $this->required,
            sometimes: "",
        )->assertStatus(200)
            ->assertOk()
            ->assertJson([
                "required" => $this->required,
                "sometimes" => null,
            ]);
    }

    public function test_bothParametersShouldBeValid()
    {
        $this->request(
            required: $this->required,
            sometimes: $this->sometimes,
        )->assertStatus(200)
            ->assertOk()
            ->assertJson([
                "required" => $this->required,
                "sometimes" => $this->sometimes,
            ]);
    }

    private function getUrl(mixed $required, mixed $sometimes): string
    {
        return sprintf(
            "%s/%s/%s",
            $this->getPath(),
            $required,
            $sometimes,
        );
    }

    private function request(
        mixed $required,
        mixed $sometimes
    ): TestResponse
    {
        $method = strtolower($this->getMethod()->value);
        return $this->{$method}($this->getUrl($required, $sometimes));
    }
}