<?php

namespace Tests\Unit\Attributes;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Attributes\WhereIn;
use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;

class WhereInTest extends TestCase
{
    private ?EndpointConfig $endpointConfig;

    public function getInstance(array|string $name, array $values): WhereIn
    {
        $this->endpointConfig = new EndpointConfig();

        $instance = new WhereIn($name, $values);
        $instance->apply($this->endpointConfig);

        return $instance;
    }

    public function test_singleNameCase()
    {
        $this->getInstance(
            "status",
            [1, 2, 3]
        );

        $this->assertEquals(
            [
                [
                    "status",
                    [1, 2, 3]
                ]
            ],
            $this->endpointConfig->getWhereIn()
        );
    }

    public function test_multipleNameCase()
    {
        $this->getInstance(["status", "user_status"], [1, 2]);

        $this->assertEquals(
            [
                [["status", "user_status"], [1, 2]],
            ],
            $this->endpointConfig->getWhereIn()
        );
    }

}