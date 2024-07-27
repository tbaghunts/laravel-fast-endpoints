<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Get;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

use Tests\Unit\Attributes\Abstract\MethodTestCase;

class GetTest extends MethodTestCase
{
    protected function getNamespace(): string
    {
        return Get::class;
    }

    protected function getPathArg(): string
    {
        return "/path/to/get";
    }

    public function test_method()
    {
        $this->assertEquals(
            [EnumEndpointMethod::GET],
            $this->getInstance()->getMethod()
        );
    }

    public function test_path()
    {
        $this->assertEquals(
            "/path/to/get",
            $this->getInstance()->getPath()
        );
    }
}