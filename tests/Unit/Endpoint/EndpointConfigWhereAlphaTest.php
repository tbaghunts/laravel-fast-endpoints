<?php

namespace Tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class EndpointConfigWhereAlphaTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeEmptyWhereAlphaConditions()
    {
        $this->assertEmpty($this->endpointConfig->getWhereAlpha());
    }
    public function test_shouldBeAbilityToSetupWhereAlpha()
    {
        $this->endpointConfig->setWhereAlpha('name');
        $this->assertEquals(['name'], $this->endpointConfig->getWhereAlpha());
    }
    public function test_shouldBeAbilityToSetupMultipleWhereAlpha()
    {
        $this->endpointConfig->setWhereAlpha(['name', 'surname']);
        $this->assertEquals(['name', 'surname'], $this->endpointConfig->getWhereAlpha());
    }
    public function test_shouldBeAbilityToInsertWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereAlpha(['name', 'middle']);
        $this->assertEquals(['name', 'middle'], $this->endpointConfig->getWhereAlpha());

        $this->endpointConfig->addWhereAlpha('surname');
        $this->assertEquals(['name', 'middle', 'surname'], $this->endpointConfig->getWhereAlpha());
    }
    public function test_shouldBeAbilityToInsertMultipleWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereAlpha(['name', 'middle']);
        $this->assertEquals(['name', 'middle'], $this->endpointConfig->getWhereAlpha());

        $this->endpointConfig->addWhereAlpha(['surname', 'age']);
        $this->assertEquals(['name', 'middle', 'surname', 'age'], $this->endpointConfig->getWhereAlpha());
    }
}