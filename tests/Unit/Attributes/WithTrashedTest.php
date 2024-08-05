<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\WithTrashed;

use Tests\Unit\Attributes\Abstract\BoolTestCase;

class WithTrashedTest extends BoolTestCase
{

    public function getNamespace(): string
    {
        return WithTrashed::class;
    }

    protected function getConfigMethodName(): string
    {
        return "getWithTrashed";
    }
}