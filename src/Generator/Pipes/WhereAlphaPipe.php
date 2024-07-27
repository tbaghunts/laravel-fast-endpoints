<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

class WhereAlphaPipe extends RouteWherePipe
{
    protected function getRouteConfigProperty(): string
    {
        return 'getWhereAlpha';
    }

    protected function getRouteMethodKey(): string
    {
        return 'whereAlpha';
    }
}