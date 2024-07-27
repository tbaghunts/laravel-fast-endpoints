<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Patch;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

use Tests\Unit\Attributes\Abstract\MethodTestCase;

class PatchTest extends MethodTestCase
{
    protected function getNamespace(): string
    {
        return Patch::class;
    }

    protected function getPathArg(): string
    {
        return "/path/to/patch";
    }

    public function test_method()
    {
        $this->assertEquals(
            [EnumEndpointMethod::PATCH],
            $this->getInstance()->getMethod()
        );
    }

    public function test_path()
    {
        $this->assertEquals(
            "/path/to/patch",
            $this->getInstance()->getPath()
        );
    }

}