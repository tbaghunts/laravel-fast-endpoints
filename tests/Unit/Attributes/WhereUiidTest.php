<?php

namespace Tests\Unit\Attributes;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Attributes\WhereUlid;
use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;

class WhereUiidTest extends TestCase
{
    private ?EndpointConfig $endpointConfig;

    public function getInstance(array|string $parameters): WhereUlid
    {
        $this->endpointConfig = new EndpointConfig();

        $instance = new WhereUlid($parameters);
        $instance->apply($this->endpointConfig);

        return $instance;
    }

    public function test_singleParameterCase()
    {
        $this->getInstance("param");

        $this->assertEquals(
            ["param"],
            $this->endpointConfig->getWhereUlid()
        );
    }

    public function test_multipleParametersCase()
    {
        $this->getInstance(["first-param", "second-param"]);

        $this->assertEquals(
            ["first-param", "second-param"],
            $this->endpointConfig->getWhereUlid()
        );
    }

}