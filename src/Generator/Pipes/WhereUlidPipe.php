<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

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