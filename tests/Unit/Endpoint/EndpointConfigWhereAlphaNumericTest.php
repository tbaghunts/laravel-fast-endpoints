<?php

namespace Baghunts\tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class EndpointConfigWhereAlphaNumericTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeEmptyWhereAlphaConditions()
    {
        $this->assertEmpty($this->endpointConfig->getWhereAlphaNumeric());
    }
    public function test_shouldBeAbilityToSetupWhereAlpha()
    {
        $this->endpointConfig->setWhereAlphaNumeric('uuid');
        $this->assertEquals(['uuid'], $this->endpointConfig->getWhereAlphaNumeric());
    }
    public function test_shouldBeAbilityToSetupMultipleWhereAlpha()
    {
        $this->endpointConfig->setWhereAlphaNumeric(['uuid', 'ulid']);
        $this->assertEquals(['uuid', 'ulid'], $this->endpointConfig->getWhereAlphaNumeric());
    }
    public function test_shouldBeAbilityToInsertWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereAlphaNumeric(['uuid', 'ulid']);
        $this->assertEquals(['uuid', 'ulid'], $this->endpointConfig->getWhereAlphaNumeric());

        $this->endpointConfig->addWhereAlphaNumeric('sku');
        $this->assertEquals(['uuid', 'ulid', 'sku'], $this->endpointConfig->getWhereAlphaNumeric());
    }
    public function test_shouldBeAbilityToInsertMultipleWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereAlphaNumeric(['uuid', 'ulid']);
        $this->assertEquals(['uuid', 'ulid'], $this->endpointConfig->getWhereAlphaNumeric());

        $this->endpointConfig->addWhereAlphaNumeric(['sku', 'hmac']);
        $this->assertEquals(['uuid', 'ulid', 'sku', 'hmac'], $this->endpointConfig->getWhereAlphaNumeric());
    }
}