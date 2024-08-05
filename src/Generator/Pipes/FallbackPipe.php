<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

class FallbackPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $fallback = $generator->getEndpointConfiguration()->getFallback();
        if ($fallback) {
            $generator->getRoute()->fallback();
        }

        $next($generator);
    }
}