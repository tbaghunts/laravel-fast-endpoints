<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
use function PHPUnit\Framework\matches;

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