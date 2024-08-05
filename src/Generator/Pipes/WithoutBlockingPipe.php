<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

class WithoutBlockingPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $withoutBlock = $generator->getEndpointConfiguration()->getWithoutBlocking();
        if ($withoutBlock) {
            $generator->getRoute()->withoutBlocking();
        }

        $next($generator);
    }
}