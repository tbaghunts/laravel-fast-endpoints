<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoints\Attributes\Can;

use Tests\Unit\Attributes\Abstract\TestCase;

class CanTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Can::class;
    }

    public function test_defaultCase()
    {
        $this->assertEmpty($this->endpointConfig->getCan());
    }

    public function test_singleValueCase()
    {
        $this->getInstance([
            "ability" => "update",
            "models" => "App\\Models\\User",
        ]);
        $this->assertEquals([
            "update" => "App\\Models\\User",
        ], $this->endpointConfig->getCan());
    }

    public function test_multipleValueCase()
    {
        $this->getInstance([
            "ability" => [
                "update" => "App\\Models\\User",
                "delete" => [
                    "App\\Models\\User",
                    "App\\Models\\Post",
                ],
            ],
        ]);
        $this->assertEquals([
            "update" => "App\\Models\\User",
            "delete" => [
                "App\\Models\\User",
                "App\\Models\\Post",
            ]
        ], $this->endpointConfig->getCan());
    }

    public function test_repeatableValueCase()
    {
        $this->getInstance([
            "ability" => "delete",
            "models" => "App\\Models\\User",
        ]);
        $this->getInstance([
            "ability" => [
                "update" => [
                    "App\\Models\\User",
                    "App\\Models\\Post",
                ],
            ],
        ]);
        $this->getInstance([
            "ability" => [
                "create" => [
                    "App\\Models\\Payment",
                ],
            ],
        ]);

        $this->assertEquals([
            "delete" => "App\\Models\\User",
            "update" => [
                "App\\Models\\User",
                "App\\Models\\Post",
            ],
            "create" => [
                "App\\Models\\Payment",
            ]
        ], $this->endpointConfig->getCan());
    }
}