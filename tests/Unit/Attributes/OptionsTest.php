<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoints\Attributes\Options;
use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

use Tests\Unit\Attributes\Abstract\MethodTestCase;

class OptionsTest extends MethodTestCase
{
    public function getNamespace(): string
    {
        return Options::class;
    }

    protected function getPathArg(): string
    {
        return "/path/to/options";
    }

    public function test_method()
    {
        $this->assertEquals(
            [EnumEndpointMethod::OPTIONS],
            $this->getInstance()->getMethod()
        );
    }

    public function test_path()
    {
        $this->assertEquals(
            "/path/to/options",
            $this->getInstance()->getPath()
        );
    }
}