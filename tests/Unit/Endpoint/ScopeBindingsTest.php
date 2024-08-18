<?php

namespace Tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class ScopeBindingsTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeNullableScoping()
    {
        $this->assertNull($this->endpointConfig->getScopeBindings());
    }
    public function test_shouldBeAbilityToEnableScopeBinding()
    {
        $this->endpointConfig->withScopeBindings();
        $this->assertTrue($this->endpointConfig->getScopeBindings());
    }
    public function test_shouldBeAbilityToDisableScopeBinding()
    {
        $this->endpointConfig->withoutScopeBindings();
        $this->assertFalse($this->endpointConfig->getScopeBindings());
    }
    public function test_shouldBeAbilityToSkipScopeBinding()
    {
        $this->endpointConfig->setScopeBindings(true);
        $this->assertTrue($this->endpointConfig->getScopeBindings());

        $this->endpointConfig->setScopeBindings(null);
        $this->assertNull($this->endpointConfig->getScopeBindings());
    }
}