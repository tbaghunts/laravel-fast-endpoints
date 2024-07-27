<?php

namespace Tests\Unit\Generator;

use ReflectionClass;
use ReflectionException;

use Orchestra\Testbench\TestCase;
use Orchestra\Testbench\Concerns\WithWorkbench;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoint\Generator\RouteGenerator;
use Baghunts\LaravelFastEndpoint\Contracts\{
    EndpointConfigContract,
    RouteGeneratorContract
};

class RouteGeneratorTest extends TestCase
{
    use WithWorkbench, RefreshDatabase;

    private EndpointConfigContract $config;

    private array $defaultConfig = [
        "name" => "fast.route",
        "path" => "/fast/route",
        "middleware" => ["guest", "full-guest"],
        "withTrashed" => null,
        "scopeBindings" => true,
        "where" => [
            ["number-param" => "[0-9]+"]
        ],
        "whereIn" => [
            ["in-1", [1, 2, 3]],
            [["in-a", "in-b"], ["a", "b"]],
        ],
        "whereUuid" => [
            "uuid",
            "guid",
        ],
        "whereUlid" => [
            "ulid",
        ],
        "whereAlpha" => [
            "name"
        ],
        "whereNumber" => [
            "id",
            "age",
        ],
        "whereAlphaNumeric" => [
            "sku"
        ],
        "method" => [
            EnumEndpointMethod::GET,
            EnumEndpointMethod::HEAD,
            EnumEndpointMethod::POST,
        ],
    ];

    private function makeConfig(array $config = []): EndpointConfigContract
    {
        return app(EndpointConfig::class, $config);
    }

    private function getInstance(array $config): RouteGeneratorContract
    {
        $this->config = $this->makeConfig($config);

        return new RouteGenerator(
            "RouteClassNamespace",
            $this->config,
        );
    }

    public function test_getEndpointConfiguration(): void
    {
        $instance = $this->getInstance($this->defaultConfig);
        $this->assertSame($instance->getEndpointConfiguration(), $this->config);
    }

    public function test_getEndpointClassNamespace(): void
    {
        $this->assertEquals(
            "RouteClassNamespace",
            $this->getInstance($this->defaultConfig)->getEndpointClassNamespace()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function test_addStatement(): void
    {
        $instance = $this->getInstance($this->defaultConfig);

        $reflector = new ReflectionClass($instance);
        $property = $reflector->getProperty("statements");

        $this->assertEquals([], $property->getValue($instance));

        $instance->addStatement("testStatement1");
        $instance->addStatement("testStatement2");
        $this->assertEquals(["testStatement1", "testStatement2"], $property->getValue($instance));

        $instance->addStatement("testStatement3");
        $this->assertEquals(["testStatement1", "testStatement2", "testStatement3"], $property->getValue($instance));
    }

    public function test_output(): void
    {
        $instance = $this->getInstance($this->defaultConfig);

        $this->assertEquals(
            implode("->", [
                "Route::match(['get','head','post'],'/fast/route',RouteClassNamespace::class)",
                "setWheres(json_decode('[{\"number-param\":\"[0-9]+\"}]',true))",
                "name('fast.route')",
                "whereUuid('uuid')",
                "whereUuid('guid')",
                "whereUlid('ulid')",
                "whereAlpha('name')",
                "whereNumber('id')",
                "whereNumber('age')",
                "scopeBindings()",
                "whereAlphaNumeric('sku');"
            ]),
            $instance->output()
        );
    }

}