<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

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