<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

class WhereUlidPipe extends RouteWherePipe
{
    protected function getRouteConfigProperty(): string
    {
        return 'getWhereUlid';
    }

    protected function getRouteMethodKey(): string
    {
        return 'whereUlid';
    }
}