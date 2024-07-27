<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Delete;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

use Tests\Unit\Attributes\Abstract\MethodTestCase;

class DeleteTest extends MethodTestCase
{
    protected function getNamespace(): string
    {
        return Delete::class;
    }

    protected function getPathArg(): string
    {
        return "/path/to/delete";
    }

    public function test_method()
    {
        $this->assertEquals(
            [EnumEndpointMethod::DELETE],
            $this->getInstance()->getMethod()
        );
    }

    public function test_path()
    {
        $this->assertEquals(
            "/path/to/delete",
            $this->getInstance()->getPath()
        );
    }
}