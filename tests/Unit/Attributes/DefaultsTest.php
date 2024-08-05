<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Defaults;

use Tests\Unit\Attributes\Abstract\TestCase;

class DefaultsTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Defaults::class;
    }

    public function test_defaultShouldBeEmptyArray()
    {
        $this->assertEquals([], $this->endpointConfig->getDefaults());
    }

    public function test_singleDefaultsCase()
    {
        $this->getInstance([
            "key" => "user",
            "value" => 123,
        ]);

        $this->assertEquals(
            [
                "user" => 123,
            ],
            $this->endpointConfig->getDefaults()
        );
    }

    public function test_multipleDefaultsCase()
    {
        $this->getInstance([
            "key" => [
                "user" => 123,
                "slug" => "user-123",
                "action" => "delete",
            ],
            "value" => "value which will be skipped",
        ]);

        $this->assertEquals(
            [
                "user" => 123,
                "slug" => "user-123",
                "action" => "delete",
            ],
            $this->endpointConfig->getDefaults()
        );
    }

    public function test_attributeShouldBeRepeatable()
    {
        $this->getInstance([
            "key" => "post",
            "value" => 1,
        ]);
        $this->getInstance([
            "key" => [
                "redirect" => "//posts",
            ],
            "value" => "skip-value"
        ]);
        $this->getInstance([
            "key" => [
                "slug" => "post",
                "action" => "update",
            ],
            "value" => "skip-value"
        ]);

        $this->assertEquals(
            [
                "post" => 1,
                "redirect" => "//posts",
                "slug" => "post",
                "action" => "update",
            ],
            $this->endpointConfig->getDefaults()
        );
    }
}