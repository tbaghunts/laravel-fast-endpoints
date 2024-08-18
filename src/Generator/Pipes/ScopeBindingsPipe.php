<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\RouteGeneratorContract;
use Closure;

class ScopeBindingsPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $scopeBindings = $generator->getEndpointConfiguration()->getScopeBindings();
        if (is_bool($scopeBindings)) {
            $route = $generator->getRoute();
            match($scopeBindings) {
                true => $route->scopeBindings(),
                false => $route->withoutScopedBindings(),
            };
        }

        $next($generator);
    }
}