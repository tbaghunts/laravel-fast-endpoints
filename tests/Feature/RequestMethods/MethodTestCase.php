<?php

namespace Tests\Feature\RequestMethods;

use Illuminate\Support\Str;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

use Tests\Feature\TestCase;

abstract class MethodTestCase extends TestCase
{
    private array $requestData = [];
    private ?EnumEndpointMethod $currentMethod;

    protected abstract function getUrl(): string;
    protected abstract function getMethod(): EnumEndpointMethod;

    protected function setUp(): void
    {
        parent::setUp();

        $this->currentMethod = $this->getMethod();
        $this->requestData = [
          "text" => Str::random(),
          "uuid" => Str::uuid()->toString(),
        ];
    }

    public function test_execMethodTests()
    {
        foreach (EnumEndpointMethod::cases() as $method) {
            if ($method === EnumEndpointMethod::ANY) {
                continue;
            }

            $this->execConcreteMethodTest($method);
        }
    }

    private function execConcreteMethodTest(EnumEndpointMethod $method): void
    {
        $testMethod = Str::of($method->value)->lower()->toString();

        $this->assertTrue(method_exists($this, $testMethod));

        $response = $this->{$testMethod}($this->generateUrl(), $this->requestData, [
            'Accept' => 'application/json',
        ])->assertStatus($this->getAssertStatusByMethod($method));

        if ($method === $this->currentMethod) {
            $response->assertJson([
                "data" => $this->requestData,
                "method" => $this->currentMethod->value,
            ]);
        }
    }

    private function generateUrl(): string
    {
        $url = $this->getUrl();

        if (in_array($this->getMethod(), [EnumEndpointMethod::HEAD, EnumEndpointMethod::GET])) {
            return sprintf("%s?%s", $url, http_build_query($this->requestData));
        }

        return $url;
    }

    private function getAssertStatusByMethod(EnumEndpointMethod $method): int
    {
        if ($this->currentMethod === EnumEndpointMethod::ANY) {
            return 200;
        }

        $allowedMethods = [
            $this->currentMethod,
            EnumEndpointMethod::OPTIONS,
        ];

        if ($this->currentMethod === EnumEndpointMethod::GET) {
            $allowedMethods[] = EnumEndpointMethod::HEAD;
        }

        if (in_array($method, $allowedMethods)) {
            return 200;
        }

        return 405;
    }

}