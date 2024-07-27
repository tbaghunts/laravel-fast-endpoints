<?php

namespace Tests\Unit\Attributes;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Attributes\WhereNumber;
use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;

class WhereNumberTest extends TestCase
{
    private ?EndpointConfig $endpointConfig;

    public function getInstance(array|string $parameters): WhereNumber
    {
        $this->endpointConfig = new EndpointConfig();

        $instance = new WhereNumber($parameters);
        $instance->apply($this->endpointConfig);

        return $instance;
    }

    public function test_singleParameterCase()
    {
        $this->getInstance("id");

        $this->assertEquals(
            ["id"],
            $this->endpointConfig->getWhereNumber()
        );
    }

    public function test_multipleParametersCase()
    {
        $this->getInstance(["id", "age", "status"]);

        $this->assertEquals(
            ["id", "age", "status"],
            $this->endpointConfig->getWhereNumber()
        );
    }

}