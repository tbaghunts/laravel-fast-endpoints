<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

class WhereAlphaNumericPipe extends RouteWherePipe
{
    protected function getRouteConfigProperty(): string
    {
        return 'getWhereAlphaNumeric';
    }

    protected function getRouteMethodKey(): string
    {
        return 'whereAlphaNumeric';
    }
}