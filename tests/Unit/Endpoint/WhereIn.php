<?php

namespace Tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class WhereIn extends EndpointConfigTestCase
{
    public function test_defaultShouldBeEmptyArray()
    {
        $this->assertEmpty($this->endpointConfig->getWhereIn());
    }
    public function test_shouldBeAbilityToSetupWhereIn()
    {
        $this->endpointConfig->setWhereIn([
            "whereIn",
            [1, 2, 3]
        ]);
        $this->assertEquals(
            [
                "whereIn",
                [1, 2, 3],
            ],
            $this->endpointConfig->getWhereIn()
        );

        $this->endpointConfig->setWhereIn([
            "whereAnotherIn",
            [3, 2, 1]
        ]);
        $this->assertEquals(
            [
                "whereAnotherIn",
                [3, 2, 1],
            ],
            $this->endpointConfig->getWhereIn()
        );
    }
    public function test_shouldBeAbleToBeInsertedIntoExistingItems()
    {
        $this->endpointConfig->setWhereIn([
            [
                'status',
                [0, 1]
            ]
        ]);
        $this->assertEquals(
            [['status', [0, 1]]],
            $this->endpointConfig->getWhereIn()
        );

        $this->endpointConfig->addWhereIn("priority", ["high", "low"]);
        $this->assertEquals(
            [
                ["status", [0, 1]],
                ["priority", ["high", "low"]],
            ],
            $this->endpointConfig->getWhereIn()
        );

        $this->endpointConfig->addWhereIn("component", ["frontend", "backend"]);
        $this->assertEquals(
            [
                ["status", [0, 1]],
                ["priority", ["high", "low"]],
                ["component", ["frontend", "backend"]],
            ],
            $this->endpointConfig->getWhereIn()
        );

        $this->endpointConfig->addWhereIn(
            ["is_active", "is_suspended"], [0, 1]);
        $this->assertEquals(
            [
                ["status", [0, 1]],
                ["priority", ["high", "low"]],
                ["component", ["frontend", "backend"]],
                [["is_active", "is_suspended"], [0, 1]],
            ],
            $this->endpointConfig->getWhereIn()
        );
    }
}