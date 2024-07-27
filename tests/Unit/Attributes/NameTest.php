<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Name;

use Tests\Unit\Attributes\Abstract\TestCase;

class NameTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Name::class;
    }

    public function test_defaultShouldBeNull()
    {
        $this->assertEquals(
            null,
            $this->getInstance()->getName()
        );
    }

    public function test_withSpecifiedRouteName()
    {
        $this->assertEquals(
            "cool.route.name",
            $this->getInstance(["cool.route.name"])->getName()
        );
    }
}