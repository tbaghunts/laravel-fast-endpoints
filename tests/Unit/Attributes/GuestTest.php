<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Guest;

use Tests\Unit\Attributes\Abstract\TestCase;

class GuestTest extends TestCase
{
    public function getNamespace(): string
    {
        return Guest::class;
    }

    public function test_shouldAddGuestMiddleware()
    {
        $this->assertEquals(
            ["guest"],
            $this->getInstance()->getMiddleware()
        );
    }

    public function test_guestMiddlewareShouldBeAppendedInsteadOfOverwrite()
    {
        $this->getInstance(["middleware-1", "middleware-2"]);

        $this->assertEquals(
            ["middleware-1", "middleware-2", "guest"],
            $this->getInstance()->getMiddleware()
        );
    }
}