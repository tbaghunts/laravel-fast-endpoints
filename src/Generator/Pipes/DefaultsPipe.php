<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
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