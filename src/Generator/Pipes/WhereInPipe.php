<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

class WhereInPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $whereIn = $generator->getEndpointConfiguration()->getWhereIn();
        if (!empty($whereIn)) {
            $route = $generator->getRoute();
            foreach ($whereIn as $value) {
                $route->whereIn(...$value);
            }
        }

        $next($generator);
    }
}