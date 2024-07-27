<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

class RouteNamePipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $endpointName = $generator->getEndpointConfiguration()->getName();
        if (!empty($endpointName)) {
            $generator->addStateMent(
                sprintf(
                    "name('%s')",
                    $endpointName
                )
            );
        }

        $next($generator);
    }
}