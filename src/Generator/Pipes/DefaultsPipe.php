<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\RouteGeneratorContract;
use Closure;

class DefaultsPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $config = $generator->getEndpointConfiguration();
        $defaults = $config->getDefaults();

        if (!empty($defaults)) {
            $generator->getRoute()->setDefaults($defaults);
        }

        $next($generator);
    }

}