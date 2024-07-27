<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Any;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

use Tests\Unit\Attributes\Abstract\MethodTestCase;

class AnyTest extends MethodTestCase
{
    protected function getNamespace(): string
    {
        return Any::class;
    }

    public function test_method()
    {
        $this->assertEquals(
            [EnumEndpointMethod::ANY],
            $this->getInstance()->getMethod()
        );
    }

    public function test_path()
    {
        $this->assertEquals(
            "/path/to/any",
            $this->getInstance()->getPath()
        );
    }
}