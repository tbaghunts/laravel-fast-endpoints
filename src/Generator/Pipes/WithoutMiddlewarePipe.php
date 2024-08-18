<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\RouteGeneratorContract;
use Closure;

class WithoutMiddlewarePipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $withoutMiddleware = $generator->getEndpointConfiguration()->getWithoutMiddleware();
        if (!empty($withoutMiddleware)) {
            $generator->getRoute()->withoutMiddleware($withoutMiddleware);
        }

        $next($generator);
    }
}