<?php

namespace Tests\Unit\Endpoint;

use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class MethodTest extends EndpointConfigTestCase
{
    public function test_defaultShouldBeNullableName()
    {
        $this->assertNull($this->endpointConfig->getName());
    }
    public function test_shouldBeAbilityToSetupRouteName()
    {
        $this->endpointConfig->setName("route.name");
        $this->assertEquals("route.name", $this->endpointConfig->getName());
    }

    public function test_defaultShouldBeNullablePath()
    {
        $this->assertNull($this->endpointConfig->getPath());
    }
    public function test_defaultShouldBeAbilityToSetupPath()
    {
        $this->endpointConfig->setPath("route.path");
        $this->assertEquals("route.path", $this->endpointConfig->getPath());
    }

    public function test_defaultShouldBeEmptyMethods()
    {
        $this->assertEquals([], $this->endpointConfig->getMethod());
    }
    public function test_singleMethodSetupShouldReturnArray()
    {
        $this->endpointConfig->setMethod(EnumEndpointMethod::POST);
        $this->assertEquals([EnumEndpointMethod::POST], $this->endpointConfig->getMethod());
    }
    public function test_shouldBeAbilityToSetupMultipleMethods()
    {
        $this->endpointConfig->setMethod([EnumEndpointMethod::PUT, EnumEndpointMethod::POST]);
        $this->assertEquals([EnumEndpointMethod::PUT, EnumEndpointMethod::POST], $this->endpointConfig->getMethod());
    }
}