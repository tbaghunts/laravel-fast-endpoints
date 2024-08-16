<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
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