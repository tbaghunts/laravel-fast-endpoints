<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

class WhereNumberPipe extends RouteWherePipe
{
    protected function getRouteConfigProperty(): string
    {
        return 'getWhereNumber';
    }

    protected function getRouteMethodKey(): string
    {
        return 'whereNumber';
    }
}