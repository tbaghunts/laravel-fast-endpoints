<?php

namespace Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\Pipes;

class WhereUuid extends WhereFamilyPipe
{
    public function getAttributeName(): string
    {
        return 'WhereUuid';
    }

    public function getOptionKey(): string
    {
        return 'where-uuid';
    }
}