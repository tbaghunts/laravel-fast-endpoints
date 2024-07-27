<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoint\Attributes\WhereAlphaNumeric;
use Orchestra\Testbench\TestCase;

class WhereAlphanumericTest extends TestCase
{
    private ?EndpointConfig $endpointConfig = null;

    public function getInstance(string|array $parameters): WhereAlphaNumeric
    {
        $this->endpointConfig = new EndpointConfig();

        $instance = new WhereAlphaNumeric($parameters);
        $instance->apply($this->endpointConfig);

        return $instance;
    }

    public function test_singleParameterCase()
    {
        $this->getInstance("sku");

        $this->assertEquals(
            ["sku"],
            $this->endpointConfig->getWhereAlphaNumeric(),
        );
    }

    public function test_multipleParameterCase()
    {
        $this->getInstance(["sku", "uuid"]);

        $this->assertEquals(
            ["sku", "uuid"],
            $this->endpointConfig->getWhereAlphaNumeric(),
        );
    }
}