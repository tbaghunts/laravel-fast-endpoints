<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\WithoutBlocking;

use Tests\Unit\Attributes\Abstract\BoolTestCase;

class WithoutBlockingTest extends BoolTestCase
{
    protected function getNamespace(): string
    {
        return WithoutBlocking::class;
    }

    protected function getConfigMethodName(): string
    {
        return "getWithoutBlocking";
    }
}