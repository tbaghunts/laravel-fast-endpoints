<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes;

class WhereUlid extends WhereFamilyPipe
{
    public function getAttributeName(): string
    {
        return 'WhereUlid';
    }

    public function getOptionKey(): string
    {
        return 'where-ulid';
    }
}