<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\RouteGeneratorContract;
use Closure;

class RouteNamePipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $endpointName = $generator->getEndpointConfiguration()->getName();

        if (!empty($endpointName)) {
            $generator->getRoute()->name($endpointName);
        }

        $next($generator);
    }
}