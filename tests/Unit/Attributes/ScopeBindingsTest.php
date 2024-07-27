<?php

namespace Tests\Unit\Attributes;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoint\Attributes\ScopeBindings;

class ScopeBindingsTest extends TestCase
{
    private ?EndpointConfig $endpointConfig;

    public function getInstance(null|bool|int $scopeBindings = 0): ScopeBindings
    {
        $this->endpointConfig = new EndpointConfig();

        $instance = !is_numeric($scopeBindings) ? new ScopeBindings($scopeBindings) : new ScopeBindings();
        $instance->apply($this->endpointConfig);

        return $instance;
    }

    public function test_defaultShouldBeTrue()
    {
        $this->getInstance();

        $this->assertTrue($this->endpointConfig->getScopeBindings());
    }


    public function test_booleanValues()
    {
        $this->getInstance(false);
        $this->assertFalse($this->endpointConfig->getScopeBindings());

        $this->getInstance(true);
        $this->assertTrue($this->endpointConfig->getScopeBindings());
    }

    public function test_nullValue()
    {
        $this->getInstance(null);

        $this->assertNull($this->endpointConfig->getScopeBindings());
    }
}