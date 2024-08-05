<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Block;

use Tests\Unit\Attributes\Abstract\TestCase;

class BlockTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Block::class;
    }

    public function test_defaultCase()
    {
        $this->assertEmpty($this->endpointConfig->getBlock());
    }

    public function test_withoutPramsCase()
    {
        $this->getInstance();
        $this->assertEquals([null, null], $this->endpointConfig->getBlock());
    }

    public function test_withLockParamCase()
    {
        $this->getInstance([
            "lockSeconds" => 20,
        ]);
        $this->assertEquals([20, null], $this->endpointConfig->getBlock());
    }

    public function test_withWaitParamCase()
    {
        $this->getInstance([
            "waitSeconds" => 20,
        ]);
        $this->assertEquals([null, 20], $this->endpointConfig->getBlock());
    }

    public function test_withFullParams()
    {
        $this->getInstance([
            "waitSeconds" => 7,
            "lockSeconds" => 43,
        ]);
        $this->assertEquals([43, 7], $this->endpointConfig->getBlock());
    }
}