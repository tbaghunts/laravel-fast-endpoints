<?php

namespace Tests\Unit\Attributes;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Attributes\Where;
use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;

class WhereTest extends TestCase
{
    private EndpointConfig $endpointConfig;

    private function getInstance(string|array $name, ?string $expression = null): void
    {
        $this->endpointConfig = new EndpointConfig();

        $instance = new Where($name, $expression);
        $instance->apply($this->endpointConfig);

    }

    public function test_singleWhereShouldBeAddedToList()
    {
        $this->getInstance("whereName", "whereExpression");

        $this->assertEquals(
            [
                ["whereName", "whereExpression"],
            ],
            $this->endpointConfig->getWhere()
        );
    }

    public function test_multipleWhereShouldBeAddedToList()
    {
        $this->getInstance([
            "where1" => "where1Expression",
            "where2" => "where2Expression",
            "where3" => "where3Expression",
        ]);

        $this->assertEquals(
            [
                [
                    "where1" => "where1Expression",
                    "where2" => "where2Expression",
                    "where3" => "where3Expression",
                ],
            ],
            $this->endpointConfig->getWhere()
        );
    }
}