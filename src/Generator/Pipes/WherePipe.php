<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

class WherePipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $endpointWhere = $generator->getEndpointConfiguration()->getWhere();
        if (!empty($endpointWhere)) {
            $generator->getRoute()->where($endpointWhere);
        }

        $next($generator);
    }
}