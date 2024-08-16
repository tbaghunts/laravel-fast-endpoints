<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
use Closure;

class MiddlewarePipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $middleware = $generator->getEndpointConfiguration()->getMiddleware();
        if (!empty($middleware)) {
            $generator->getRoute()->middleware($middleware);
        }

        $next($generator);
    }
}