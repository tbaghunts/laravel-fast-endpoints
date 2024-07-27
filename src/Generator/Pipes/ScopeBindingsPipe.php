<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

class ScopeBindingsPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $scopeBindings = $generator->getEndpointConfiguration()->getScopeBindings();

        if (!!$scopeBindings) {
            $generator->addStatement("scopeBindings()");
        }

        $next($generator);
    }
}