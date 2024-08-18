<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

class WhereUuidPipe extends RouteWherePipe
{
    protected function getRouteConfigProperty(): string
    {
        return 'getWhereUuid';
    }

    protected function getRouteMethodKey(): string
    {
        return 'whereUuid';
    }
}