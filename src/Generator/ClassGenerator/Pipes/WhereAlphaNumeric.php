<?php

namespace Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\Pipes;

class WhereAlphaNumeric extends WhereFamilyPipe
{
    public function getAttributeName(): string
    {
        return 'WhereAlphaNumeric';
    }

    public function getOptionKey(): string
    {
        return 'where-alpha-numeric';
    }
}