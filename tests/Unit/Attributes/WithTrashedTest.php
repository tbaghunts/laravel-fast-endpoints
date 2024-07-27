<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\WithTrashed;

class WithTrashedTest extends TestCase
{

    public function getNamespace(): string
    {
        return WithTrashed::class;
    }

    public function test_withTrashed()
    {
        $this->endpointConfig->withoutTrashed();

        $this->assertFalse(
            $this->endpointConfig->getWithTrashed()
        );

        $this->getInstance();

        $this->assertTrue(
            $this->endpointConfig->getWithTrashed()
        );
    }
}