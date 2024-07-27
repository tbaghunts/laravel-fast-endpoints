<?php

namespace Tests\Unit\Attributes;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Attributes\WhereUuid;
use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;

class WhereUuidTest extends TestCase
{
    private ?EndpointConfig $endpointConfig;

    public function getInstance(array|string $parameters): WhereUuid
    {
        $this->endpointConfig = new EndpointConfig();

        $instance = new WhereUuid($parameters);
        $instance->apply($this->endpointConfig);

        return $instance;
    }

    public function test_singleParameterCase()
    {
        $this->getInstance("secure");

        $this->assertEquals(
            ["secure"],
            $this->endpointConfig->getWhereUuid()
        );
    }

    public function test_multipleParametersCase()
    {
        $this->getInstance(["secure", "user", "transaction", "history"]);

        $this->assertEquals(
            ["secure", "user", "transaction", "history"],
            $this->endpointConfig->getWhereUuid()
        );
    }

}