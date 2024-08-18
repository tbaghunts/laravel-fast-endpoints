<?php

namespace Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\Pipes;

class WhereNumber extends WhereFamilyPipe
{
    public function getAttributeName(): string
    {
        return 'WhereNumber';
    }

    public function getOptionKey(): string
    {
        return 'where-number';
    }
}