<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Fallback;

use Tests\Unit\Attributes\Abstract\BoolTestCase;

class FallbackTest extends BoolTestCase
{
    protected function getNamespace(): string
    {
        return Fallback::class;
    }

    protected function getConfigMethodName(): string
    {
        return "getFallback";
    }
}