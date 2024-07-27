<?php

namespace Tests\Unit\Attributes;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Attributes\WhereAlpha;
use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;

class WhereAlphaTest extends TestCase
{
    private ?EndpointConfig $endpointConfig = null;

    public function getInstance(string|array $parameters): WhereAlpha
    {
        $this->endpointConfig = new EndpointConfig();

        $instance = new WhereAlpha($parameters);
        $instance->apply($this->endpointConfig);

        return $instance;
    }

    public function test_singleParameterCase()
    {
        $this->getInstance("name");

        $this->assertEquals(
            ["name"],
            $this->endpointConfig->getWhereAlpha(),
        );
    }

    public function test_multipleParametersCase()
    {
        $this->getInstance(["username", "password"]);

        $this->assertEquals(
            ["username", "password"],
            $this->endpointConfig->getWhereAlpha(),
        );
    }
}