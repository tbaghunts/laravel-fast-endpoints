<?php

namespace Baghunts\tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class WhereUlidTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeEmptyWhereAlphaConditions()
    {
        $this->assertEmpty($this->endpointConfig->getWhereUlid());
    }
    public function test_shouldBeAbilityToSetupWhereAlpha()
    {
        $this->endpointConfig->setWhereUlid('ulid');
        $this->assertEquals(['ulid'], $this->endpointConfig->getWhereUlid());
    }
    public function test_shouldBeAbilityToSetupMultipleWhereAlpha()
    {
        $this->endpointConfig->setWhereUlid(['ulid', 'guid']);
        $this->assertEquals(['ulid', 'guid'], $this->endpointConfig->getWhereUlid());
    }
    public function test_shouldBeAbilityToInsertWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereUlid(['ulid', 'guid']);
        $this->assertEquals(['ulid', 'guid'], $this->endpointConfig->getWhereUlid());

        $this->endpointConfig->addWhereUlid('token');
        $this->assertEquals(['ulid', 'guid', 'token'], $this->endpointConfig->getWhereUlid());
    }
    public function test_shouldBeAbilityToInsertMultipleWhereAlphaToExist()
    {
        $this->endpointConfig->setWhereUlid(['ulid', 'guid']);
        $this->assertEquals(['ulid', 'guid'], $this->endpointConfig->getWhereUlid());

        $this->endpointConfig->addWhereUlid(['token', 'transaction_id']);
        $this->assertEquals(['ulid', 'guid', 'token', 'transaction_id'], $this->endpointConfig->getWhereUlid());
    }
}