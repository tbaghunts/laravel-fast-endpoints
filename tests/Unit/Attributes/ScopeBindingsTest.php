<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoints\Attributes\ScopeBindings;
use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfigContract;

use Tests\Unit\Attributes\Abstract\TestCase;

class ScopeBindingsTest extends TestCase
{
    protected function getNamespace(): string
    {
        return ScopeBindings::class;
    }

    private function makeInstance(?bool $scopeBindings): EndpointConfigContract
    {
        return $this->getInstance([
            "scopeBindings" => $scopeBindings,
        ]);
    }

    public function test_defaultShouldBeTrue()
    {
        $this->assertTrue($this->getInstance()->getScopeBindings());
    }

    public function test_booleanValues()
    {
        $this->assertFalse($this->makeInstance(false)->getScopeBindings());
        $this->assertTrue($this->makeInstance(true)->getScopeBindings());
    }

    public function test_nullValue()
    {
        $this->assertNull($this->makeInstance(null)->getScopeBindings());
    }
}