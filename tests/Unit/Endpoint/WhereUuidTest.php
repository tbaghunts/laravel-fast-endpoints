<?php

namespace Tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class WhereUuidTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeEmptyWhereAlphaConditions()
    {
        $this->assertEmpty($this->endpointConfig->getWhereUuid());
    }
    public function test_shouldBeAbilityToSetupWhereAlpha()
    {
        $this->endpointConfig->setWhereUuid('uuid');
        $this->assertEquals(['uuid'], $this->endpointConfig->getWhereUuid());
    }
    public function test_shouldBeAbilityToSetupMultipleWhereAlpha()
    {
        $this->endpointConfig->setWhereUuid(['uuid', 'guid']);
        $this->assertEquals(['uuid', 'guid'], $this->endpointConfig->getWhereUuid());
    }
    public function test_shouldBeAbilityToInsertWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereUuid(['uuid', 'guid']);
        $this->assertEquals(['uuid', 'guid'], $this->endpointConfig->getWhereUuid());

        $this->endpointConfig->addWhereUuid('token');
        $this->assertEquals(['uuid', 'guid', 'token'], $this->endpointConfig->getWhereUuid());
    }
    public function test_shouldBeAbilityToInsertMultipleWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereUuid(['uuid', 'guid']);
        $this->assertEquals(['uuid', 'guid'], $this->endpointConfig->getWhereUuid());

        $this->endpointConfig->addWhereUuid(['token', 'transaction_id']);
        $this->assertEquals(['uuid', 'guid', 'token', 'transaction_id'], $this->endpointConfig->getWhereUuid());
    }
}