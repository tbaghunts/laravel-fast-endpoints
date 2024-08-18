<?php

namespace Tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class WhereTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeEmptyWhereConditions()
    {
        $this->assertEmpty($this->endpointConfig->getWhere());
    }
    public function test_shouldBeAbilityToSetupWhereConditions()
    {
        $this->endpointConfig->setWhere(["where-1", "where-2"]);
        $this->assertEquals(["where-1", "where-2"], $this->endpointConfig->getWhere());
    }
    public function test_shouldBeAbilityToInsertWhereConditionToExists()
    {
        $this->endpointConfig->setWhere(["where-1", "where-2"]);
        $this->assertEquals(["where-1", "where-2"], $this->endpointConfig->getWhere());

        $this->endpointConfig->addWhere("where-name", "where-expression");
        $this->assertEquals(
            ["where-1", "where-2", "where-name" => "where-expression"],
            $this->endpointConfig->getWhere()
        );
    }
    public function test_shouldBeAbilityToInsertMultipleWhereConditionToExists()
    {
        $this->endpointConfig->setWhere(["where-1", "where-2"]);
        $this->assertEquals(["where-1", "where-2"], $this->endpointConfig->getWhere());

        // On multiple inserting expression should be skipped
        $this->endpointConfig->addWhere(["where-name-1" => 1, "where-name-2" => 2], "where-expression");
        $this->assertEquals(
            ["where-1", "where-2", "where-name-1" => 1, "where-name-2" => 2],
            $this->endpointConfig->getWhere()
        );
    }
}