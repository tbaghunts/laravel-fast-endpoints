<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
use Closure;

class WithTrashedPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $withTrashed = $generator->getEndpointConfiguration()->getWithTrashed();
        if ($withTrashed === true) {
            $generator->getRoute()->withTrashed();
        }

        $next($generator);
    }
}