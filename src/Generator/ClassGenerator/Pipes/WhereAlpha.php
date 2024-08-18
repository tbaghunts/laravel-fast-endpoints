<?php

namespace Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\Pipes;

class WhereAlpha extends WhereFamilyPipe
{
    public function getAttributeName(): string
    {
        return 'WhereAlpha';
    }

    public function getOptionKey(): string
    {
        return 'where-alpha';
    }
}