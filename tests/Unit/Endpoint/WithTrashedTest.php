<?php

namespace Tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class WithTrashedTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeNullable()
    {
        $this->assertFalse($this->endpointConfig->getWithTrashed());
    }
    public function test_shouldBeAbilityToEnableWithTrashed()
    {
        $this->assertFalse($this->endpointConfig->getWithTrashed());

        $this->endpointConfig->withTrashed();
        $this->assertTrue($this->endpointConfig->getWithTrashed());
    }
}