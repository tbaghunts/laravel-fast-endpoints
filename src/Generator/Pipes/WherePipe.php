<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
use Closure;

class WherePipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $endpointWhere = $generator->getEndpointConfiguration()->getWhere();
        if (!empty($endpointWhere)) {
            $generator->getRoute()->setWheres($endpointWhere);
        }

        $next($generator);
    }
}