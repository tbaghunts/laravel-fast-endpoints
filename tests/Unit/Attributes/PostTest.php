<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoints\Attributes\Post;
use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

use Tests\Unit\Attributes\Abstract\MethodTestCase;

class PostTest extends MethodTestCase
{
    protected function getNamespace(): string
    {
        return Post::class;
    }

    protected function getPathArg(): string
    {
        return "/path/to/post";
    }

    public function test_method()
    {
        $this->getInstance();

        $this->assertEquals(
            [EnumEndpointMethod::POST],
            $this->endpointConfig->getMethod()
        );
    }

    public function test_path()
    {
        $this->getInstance();

        $this->assertEquals(
            "/path/to/post",
            $this->endpointConfig->getPath()
        );
    }

}