<?php

namespace Tests\Unit\Attributes\Abstract;

use Tests\Unit\Attributes\Abstract\TestCase;

abstract class BoolTestCase extends TestCase
{

    protected abstract function getConfigMethodName(): string;

    protected function getDefaultValue(): bool
    {
        return false;
    }

    public function test_defaultCase()
    {
        $this->assertEquals($this->getDefaultValue(), $this->getConfigValue());
    }

    public function test_apliedCase()
    {
        $this->getInstance();
        $this->assertTrue($this->getConfigValue());
    }

    private function getConfigValue(): bool
    {
        $method = $this->getConfigMethodName();

        if (!method_exists($this->endpointConfig, $method)) {
            return false;
        }

        return $this->endpointConfig->$method();
    }
}