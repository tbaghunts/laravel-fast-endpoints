<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoints\Attributes\Put;
use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

use Tests\Unit\Attributes\Abstract\MethodTestCase;

class PutTest extends MethodTestCase
{
    protected function getNamespace(): string
    {
        return Put::class;
    }

    protected function getPathArg(): string
    {
        return "/path/to/put";
    }

    public function test_method()
    {
        $this->assertEquals(
            [EnumEndpointMethod::PUT],
            $this->getInstance()->getMethod()
        );
    }

    public function test_path()
    {
        $this->assertEquals(
            "/path/to/put",
            $this->getInstance()->getPath()
        );
    }

}