<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Group;

use Tests\Unit\Attributes\Abstract\TestCase;

class GroupTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Group::class;
    }

    public function test_defaultCase()
    {
        $this->assertEmpty($this->endpointConfig->getGroups());
    }

    public function test_singleCase()
    {
        $this->getInstance([
            "groups" => "user-group"
        ]);

        $this->assertEquals(["user-group"], $this->endpointConfig->getGroups());
    }

    public function test_multipleCase()
    {
        $this->getInstance([
            "groups" => [
                "user-group1",
                "user-group2",
            ]
        ]);

        $this->assertEquals(["user-group1","user-group2"], $this->endpointConfig->getGroups());
    }
}