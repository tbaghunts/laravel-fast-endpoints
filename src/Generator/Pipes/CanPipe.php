<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
use Closure;

class CanPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $can = $generator->getEndpointConfiguration()->getCan();
        if (!empty($can)) {
            $router = $generator->getRoute();
            foreach ($can as $ability => $models) {
                $router->can($ability, $models);
            }
        }

        $next($generator);
    }
}