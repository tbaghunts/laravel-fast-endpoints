<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

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