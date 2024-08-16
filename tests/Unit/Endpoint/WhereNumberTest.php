<?php

namespace Tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class WhereNumberTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeEmptyWhereAlphaConditions()
    {
        $this->assertEmpty($this->endpointConfig->getWhereNumber());
    }
    public function test_shouldBeAbilityToSetupWhereAlpha()
    {
        $this->endpointConfig->setWhereNumber('id');
        $this->assertEquals(['id'], $this->endpointConfig->getWhereNumber());
    }
    public function test_shouldBeAbilityToSetupMultipleWhereAlpha()
    {
        $this->endpointConfig->setWhereNumber(['id', 'age']);
        $this->assertEquals(['id', 'age'], $this->endpointConfig->getWhereNumber());
    }
    public function test_shouldBeAbilityToInsertWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereNumber(['id', 'age']);
        $this->assertEquals(['id', 'age'], $this->endpointConfig->getWhereNumber());

        $this->endpointConfig->addWhereNumber('floor');
        $this->assertEquals(['id', 'age', 'floor'], $this->endpointConfig->getWhereNumber());
    }
    public function test_shouldBeAbilityToInsertMultipleWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereNumber(['id', 'age']);
        $this->assertEquals(['id', 'age'], $this->endpointConfig->getWhereNumber());

        $this->endpointConfig->addWhereNumber(['floor', 'year']);
        $this->assertEquals(['id', 'age', 'floor', 'year'], $this->endpointConfig->getWhereNumber());
    }
}